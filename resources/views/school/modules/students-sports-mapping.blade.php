@extends('layouts.filldart-app') @section('title', $title) @section('content')


@section('content')

<div class="container">
    <div class="t-mrg2">

        <div class="all-chaptr-cards" style="margin:0px;">
        <!-- Success message -->
        <div>
            <x-back-button title="{{$title}}"/>
        </div>
        
        <div class="container-fluid p-0">
            <x-data-listing-component
                id="students-sports-mapping-table"
                :headers="['Class','Section','Roll No.','Student Name', 'Sport','Mapped By','Mapped Date']"
                :columns="[
                    ['data' => 'display_classname', 'name' => 'display_classname'],
                    ['data' => 'section_id', 'name' => 'section_id'],
                    ['data' => 'rollno', 'name' => 'rollno'],
                    ['data' => 'student_name', 'name' => 'student_name'],
                    ['data' => 'sport_name', 'name' => 'sport_name'],
                    ['data' => 'submitted_by', 'name' => 'submitted_by'],
                    ['data' => 'mapped_on', 'name' => 'mapped_on'],
                ]"
                ajax-url="{{ route('students-sports-mapping') }}"
				:exportButtonText="'Bulk Action'"
       			:pageLength="100"                
                :enable-class-filter="false"
                :enable-class-section-filter="true"
                :enable-sports-filter="true"
                :export-buttons="[
                    [   
                        'type' => 'custom', 'text' => 'Students Sport Mapping', 'action' => 'ExportStudentSportsMapping'
                    ]
                ]"
            >
            </x-data-listing-component>
        </div>

    </div>
</div>
</div>


<script>
 function ExportStudentSportsMapping(e, dt, node, config, selectedIds) {

    if (!selectedIds || selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No students selected!',
            text: 'Please select at least one student to export.',
            confirmButtonColor: '#3085d6'
        });
        return;
    }
    Swal.fire({
        title: 'Export Selected?',
        text: `You are exporting ${selectedIds.length} student(s). Continue?`,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes, export!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#3085d6'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'info',
                title: 'Exporting...',
                text: 'Preparing your Excel file...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                url: "{{ route('expoort.students-sports-mapping') }}",
                type: 'POST',
                contentType: "application/json",
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    student_ids: selectedIds
                }),            
                xhrFields: { responseType: 'blob' },

                success: function (response, status, xhr) {
                    Swal.close();

                    let filename = "student_sports_mapping.xlsx";
                    const disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        const matches = filenameRegex.exec(disposition);
                        if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }
                    
                    const url = window.URL.createObjectURL(response);
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', filename);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    Swal.fire({
                        icon: 'success',
                        title: 'Export Complete!',
                        text: 'Your selected data has been exported successfully.',
                        confirmButtonColor: '#3085d6'
                    });

                },
                error: function (xhr) {
                    Swal.close();
                    let msg = 'Something went wrong. Please try again.';
                    if (xhr.status === 419) msg = 'Session expired. Please refresh the page.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Export Failed!',
                        text: msg,
                        confirmButtonColor: '#d33'
                    });
                }
            });
        }
    });
}
</script>



@endsection

<style type="text/css">    
table#students-sports-mapping-table th.dt-orderable-none .dt-column-order { display: none !important; }
.dt-container .top .filter-right { order: 2; margin-right: 8%; margin-top: 5px; }

.dt-button-collection.dropdown-menu {
    left: auto !important;
    right: 4px !important;
    top: 36px !important;
    border-radius: 8px 0px 8px 8px;
    border: 1px solid var(--navi-color);
    box-shadow: 0.05em 0.05em 0.15rem var(--navi-color);
}
</style>

<div class="responsive mt-4 pt-2">
    <div class="datatable-wrapper">


       
        @isset($actionsOutside)
            <div class="datatable-actions-outside d-flex justify-content-between align-items-center mb-3">
                {{ $actionsOutside }}
            </div>
        @endisset


        <div class="datatable-toolbar d-flex justify-content-between align-items-center mb-3">
            <div id="{{ $id }}-filters" class="d-flex align-items-center gap-2"></div>
        </div>


        <table id="{{ $id }}" class="table table-bordered tbl-style w-100">
            <thead>
                <tr>
                    <th style="width:40px;"><input type="checkbox" id="{{ $id }}-select-all" /></th>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>

  
    @isset($actionsInside)
        <div data-filter-slot-for="#{{ $id }}" style="display:none;">
            {{ $actionsInside }}
        </div>
    @endisset

</div>


@push('scripts')
<script>
$(function () {
    const tableId = '#{{ $id }}';
    const selectAllId = '#{{ $id }}-select-all';
    const selectedIds = new Set();
    const enableClassFilter = @json($enableClassFilter ?? false);

    const buttonsConfig = [];
    @foreach($exportButtons as $btn)
        @if(isset($btn['type']) && $btn['type'] !== 'custom')
            buttonsConfig.push({
                extend: '{{ $btn['type'] }}',
                text: '{{ $btn['text'] }}',
                exportOptions: {
                    columns: function (idx) {
                        // exclude checkbox column
                        return idx !== 0;
                    }
                }
            });
        @elseif(isset($btn['type']) && $btn['type'] === 'custom')
            buttonsConfig.push({
                text: '{{ $btn['text'] }}',
                action: function (e, dt, node, config) {
                    if (typeof window['{{ $btn['action'] ?? '' }}'] === 'function') {
                        window['{{ $btn['action'] }}'](e, dt, node, config, Array.from(selectedIds));
                    } else {
                        console.warn('Custom action not found: {{ $btn['action'] ?? '' }}');
                    }
                }
            });
        @endif
    @endforeach

    const columnsConfig = [
        {
            data: 'id',
            orderable: false,
            searchable: false,
            render: function (data) {
                const checked = selectedIds.has(data) ? 'checked' : '';
                return `<input type="checkbox" class="row-checkbox" value="${data}" ${checked} />`;
            }
        },
        ...{!! json_encode($columns) !!}
    ];

    const table = $(tableId).DataTable({
        dom: `<"top"lf><"filter-right"B>rt<"bottom"ip><"clear">`,
        lengthChange: true,
        lengthMenu: [
            [20, 40, 60, 80, 100, -1],
            [20, 40, 60, 80, 100, 'All']
        ],
        pageLength: 100,
        info: true,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ $ajaxUrl }}",
            data: function (d) {

                $('[id^="filter-"]').each(function () {
                    const name = $(this).attr('id').replace('filter-', '');
                    console.log(d)
                    d[name] = $(this).val();
                });


               /* if (enableClassFilter) {
                    d.class_id = $('#filter-class').val();
                }*/
            },


            beforeSend: function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading...',
                    text: 'Fetching data, please wait',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            complete: function () {
                Swal.close();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load data.',
                    confirmButtonColor: '#3085d6'
                });
            }
        },
        columns: columnsConfig,
        buttons: [{
            extend: 'collection',
            text: 'Export',
            className: 'exportButton',
            buttons: buttonsConfig
        }],

        initComplete: function () {

            if (enableClassFilter) {
                const classList = @json($classes ?? []);
                const $dropdown = $('<select class="form-select form-select-sm ms-2" id="filter-class"></select>');               
                $dropdown.append(new Option('All Classes', ''));


                classList.forEach(option => {
                    const section = option.section ? ` - ${option.section}` : '';
                    const displayText = option.name + section ;
                    const value = option.class_id + '-' + option.section;
                    $dropdown.append(new Option(displayText, value));
                });

               /* classList.forEach(cls => {
                    $dropdown.append(new Option(cls.className, cls.id));
                });*/

                $('<div class="pull-right"></div>').append($dropdown).appendTo(`${tableId}_wrapper .top`).next('.dt-length').addClass("pull-right");

                $('[id^="filter-"]').on('change', function () {
                    table.ajax.reload();
                });
                                
            }
        }
    });


    $(selectAllId).on('change', function () {
        const checked = this.checked;
        $('.row-checkbox', table.rows({ search: 'applied' }).nodes()).each(function () {
            this.checked = checked;
            const id = $(this).val();
            if (checked) selectedIds.add(id);
            else selectedIds.delete(id);
        });
    });


    $(tableId).on('change', '.row-checkbox', function () {
        const id = $(this).val();
        if (this.checked) selectedIds.add(id);
        else selectedIds.delete(id);

        const allChecked = $('.row-checkbox', table.rows({ search: 'applied' }).nodes()).length === 
                           $('.row-checkbox:checked', table.rows({ search: 'applied' }).nodes()).length;
        $(selectAllId).prop('checked', allChecked);
    });


    table.on('draw', function () {
        $('.row-checkbox', table.rows().nodes()).each(function () {
            const id = $(this).val();
            $(this).prop('checked', selectedIds.has(id));
        });

        const allChecked = $('.row-checkbox', table.rows({ search: 'applied' }).nodes()).length > 0 &&
                           $('.row-checkbox:checked', table.rows({ search: 'applied' }).nodes()).length === 
                           $('.row-checkbox', table.rows({ search: 'applied' }).nodes()).length;
        $(selectAllId).prop('checked', allChecked);
    });


    table.on('processing.dt', function (e, settings, processing) {
        if (processing) {
            Swal.fire({
                title: 'Loading...',
                text: 'Processing your request...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });
        } else {
            Swal.close();
        }
    });

});
</script>
@endpush


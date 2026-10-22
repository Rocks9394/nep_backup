 <?php $__env->startSection('title', $title); ?> <?php $__env->startSection('content'); ?>
<style type="text/css">
   .header-container {
       display: flex;
       align-content: center;
       align-items: center;
       margin-top: 22px;
   }
   .btn-custom-off{
        background-color: #888888 !important;
        color: white;
   }
   .toggle-group .toggle-off{
        padding: 3px 8px 0 15px !important;
    }
    .toggle-group .toggle-on{
        padding: 3px 15px 0 8px !important;
    }
    .btn-group-toggle .btn {
        background: #e9e9e9;
        color: #292775;
        border: 1px solid #ccc;
    }

    .btn-group-toggle .btn.active {
        color: #fff !important;
    }
    .btn i {
        font-size: 1rem !important;
    }


</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<div class="container">
	<div class="t-mrg2 mb-5 pb-5">

		<div class="all-chaptr-cards" style="margin: 0;">
			<div class="row">
				<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.back-button','data' => ['title' => ''.e($title).'']]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['title' => ''.e($title).'']); ?>
					 <?php $__env->slot('actionsOutside', null, []); ?> 
				        <div >
                            <!-- action buttons  -->
				        </div>
				     <?php $__env->endSlot(); ?>
				 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
			</div>
		</div>
        <div class="header-container1 justify-content-center">
            <div class="from__bx">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <!-- <div class="col">
                                <h3 class="m-0">Registered With School</h3>
                            </div> -->
                            <div class="col-12 col-auto">
                                 <!-- Toggle Buttons -->
                                <div class="btn-group btn-group-toggle justify-content-center p-0 my-2" data-toggle="buttons">
                                    <label class="btn btn-secondary btn-sm d-flex align-items-center active" style="gap:5px;">
                                        <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                        <span class="d-none d-sm-block"><i class="fa-solid fa-check"></i> Registered With School</span>
                                    </label>

                                    <!-- Export Button -->
                                    <button id="enableExportBtn" type="button" class="btn btn-secondary btn-sm d-flex align-items-center" style="gap:5px; display:none;">
                                        <span class="d-none d-sm-block trainer-action-btn">
                                            <i class="fa-solid fa-download"></i> Download Credentials
                                        </span>
                                    </button>
                                    
                                    <label class="btn btn-secondary btn-sm d-flex align-items-center" style="gap:5px;">
                                        <input type="radio" name="options" id="option2" autocomplete="off">                                        
                                        <span class="d-none d-sm-block trainer-action-btn"><i class="fa-solid fa-plus"></i> Add School Admin</span>
                                    </label>
                                </div>

                            </div>
                            
                        </div>
                       
                    </div>
                    <div id="schoolUsersList" class="col-12" style="display: none;">
                        <div id="mapped_trainer_table_container" style="margin-top: 15px;">
                            <div class="responsive">
                                    <?php if(count($schoolUsers)): ?>
                                    <table class="table table-bordered m-0">
                                        <thead>
                                            <tr>
                                             <th>#</th>
                                             <th>Admin Id</th>
                                             <th width="150px;">Name</th>
                                             <th>Designation</th>
                                             <th>Email</th>
                                             <th>Phone</th>
                                             <!-- <th>Admin ID</th> -->
                                             <th>Assigned Module</th>
                                             <th>Status</th>
                                             <th width="90px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1 ;?>
                                            <?php $__currentLoopData = $schoolUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-userid="<?php echo e($users->id); ?>">
                                                <td><?php echo e($count++); ?></td>
                                                <td><?php echo e($users->self_registrationId ?? 'N/A'); ?></td>
                                                <td><?php echo e($users->name); ?></td>
                                                <td><?php echo e($users->position); ?></td>
                                                <td><?php echo e($users->email); ?></td>
                                                <td><?php echo e($users->phone); ?></td>
                                                <td>
                                                    <?php $__currentLoopData = explode(',', $users->module_names); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="badge text-light m-1" style="background:#563d7c; font-size: 13px;  font-weight: 500;"><?php echo e(trim($module)); ?></span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>

                                                <!-- <td><?php echo e($users->dob ?? ''); ?></td> -->
                                                

                                                <td>
                                                    <input 
                                                        type="checkbox"
                                                        class="trainer-action-btn tr-action"
                                                        data-toggle="toggle"
                                                        data-on="&nbsp;Active"
                                                        data-off="&nbsp;Inactive"
                                                        data-onstyle="success"
                                                        data-offstyle="custom-off"
                                                        data-width="80"
                                                        data-size="sm"
                                                        <?php echo e($users->status == 'Active' ? 'checked' : ''); ?>

                                                        data-users-id="<?php echo e($users->id); ?>"
                                                    >
                                                </td>
                                                <td>
                                                    <a href="#" 
                                                       data-users-id="<?php echo e($users->id); ?>"
                                                       data-action="edit"
                                                       class="trainer-action-btn ">
                                                       Edit
                                                    </a>|<a href="#" 
                                                       data-users-id="<?php echo e($users->id); ?>"  
                                                       data-action="delete"
                                                       class="trainer-action-btn ">
                                                       Delete
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <?php else: ?>
                                    <p>No associated users found for this school.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div id="schoolUsersForm" class="col-12" style="display: none;">
                            <div style="background:#fff; padding:15px; border-radius:12px; margin-top:15px;">
                                <?php echo $__env->make('school.admin.add-school-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit viewer's detail modal -->

<div class="modal fade" id="viewerModal" tabindex="-1" aria-hidden="true" width=100>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h5 class="modal-title">Edit School Admin details</h5>
        <!-- Proper close button -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $__env->make('school.admin.edit-school-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </div>
</div>





<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
    let ignoreChange = false;

    $(document).ready(function () {

        function toggleSections() {
            if ($('#option2').is(':checked')) {
                $('#schoolUsersForm').show();
                $('#schoolUsersList').hide();
                $('#enableExportBtn').hide();
            } else {
                $('#schoolUsersForm').hide();
                $('#schoolUsersList').show();
                $('#schoolUsersList').addClass('trainer-action-btn');

                $('#enableExportBtn').css('display', 'inline-flex');
            }
        }
        $('input[name="options"]').on('change', function () {
            toggleSections();
        });

        toggleSections();

        $('#enableExportBtn').on('click', function () {

            $('#option1').prop('checked', true);
            $('#option2').prop('checked', false);
            $('.btn-group-toggle label').removeClass('active');
            $('#option1').closest('label').removeClass('active');

            toggleSections();
            let schoolUserIds = [];

            $('#schoolUsersList tbody tr').each(function () {
                let userid = $(this).data('userid');
                if (userid) {
                    schoolUserIds.push(userid);
                }
            });

            if (schoolUserIds.length === 0) {
                alert('No users to export!');
                return;
            }

            $.ajax({
                url: "<?php echo e(route('export.school.admin')); ?>",
                type: "POST",
                data: {
                    school_user_ids: schoolUserIds,
                    export_type: 'excel'
                },
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (blob) {

                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'school-admins.xlsx';

                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(url);
                },
                error: function (xhr) {
                    console.error(xhr);
                    alert('Error generating Excel');
                }
            });
        });

    });




    $(document).ready(function() {
        $('.trainer-action-btn').click(function(e) {
            e.preventDefault();

            let id = $(this).data('users-id');
            let action = $(this).data('action');

            if (!id || !action) return;
            
            checkAction(id, action);

        });
    });


    $(document).on('change', '.tr-action', function(e) {
        if (ignoreChange) return;
        
        e.preventDefault();

        let $checkbox = $(this);
        let id = $checkbox.data('users-id');
        let action = $checkbox.prop('checked') ? 'activate' : 'deactivate';

        checkAction(id, action, $checkbox);

    });
    const schoolUsers = <?php echo json_encode($schoolUsers, 15, 512) ?>;
    function checkAction(id, action, $checkbox = null){
        let actionText = '';

        switch (action) {
            case 'activate': actionText = 'activate School Admin'; break;
            case 'deactivate': actionText = 'deactivate School Admin'; break;
            case 'delete': actionText = 'delete School Admin'; break;
            case 'edit': actionText = 'edit School Admin details'; break;
            default: actionText = 'perform this action'; break;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `Do you really want to ${actionText}?`,
            icon: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: 'rgba(112, 112, 112, 1)',
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                if(action == 'edit'){
                    const user = schoolUsers.find(u => u.id === id);
                    if (!user) {
                        alert("User not found");
                        return;
                    }
                    $('#viewerModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#viewerModal').find('#viewerId').val(id);
                    $('#viewerModal').find('#uid').val(user.userid);
                    $('#viewerModal').find('#trainerName').val(user.name);
                    $('#viewerModal').find('#gender').val(user.gender);
                    $('#viewerModal').find('#designation').val(user.position);
                    $('#viewerModal').find('#trainerEmail').val(user.email);
                    $('#viewerModal').find('#qualification').val(user.qualification);
                    $('#viewerModal').find('#number').val(user.phone);
                    $('#viewerModal').find('#dob').val(user.dob);
                    $('input[name="module_access[]"]').prop('checked', false);

                    if(user.module_names) {
                        const modulesArray = user.module_names.split(',').map(m => m.trim());

                        modulesArray.forEach(moduleName => {
                            $('input[name="module_access[]"]').each(function() {
                                const labelText = $(this).siblings('label').text().trim();
                                if(labelText === moduleName) {
                                    $(this).prop('checked', true);
                                }
                            });
                        });
                    }
                    $('#viewerModal').modal('show');
                }else{               
                    updateUserStatus(id, action);
                }
            }else{
                if ($checkbox) {
                    ignoreChange = true;

                    $checkbox.bootstrapToggle($checkbox.prop('checked') ? 'off' : 'on');
                    setTimeout(() => { ignoreChange = false; }, 50);
                }
                console.log("cancel event");
                return;
            }
        });

    }

    function updateUserStatus(id, action){
        $.ajax({
            url: "<?php echo e(route('admin.action')); ?>",
            type: 'POST',
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                users_id: id,
                action: action
            },
            success: function(response) {
                if(response.success) {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    }

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/admin/view-school-admin.blade.php ENDPATH**/ ?>
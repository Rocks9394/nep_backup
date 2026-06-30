
<?php $__env->startSection('title', 'Goforfit | ' . $title); ?>
<?php $__env->startSection('content'); ?>


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


</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<div class="">
   

      <div class="container">
         <div class="t-mrg2">
            <div class="all-chaptr-cards">
                <div class="row">
                    <div class="col-12 col-sm">
                        <div class="heading-rw mt-3 mt-md-1 mb-0 p-0">
                            <a href="<?php echo e(route('filldart.dashboard')); ?>" class="back-button">
                                <span class="arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                    </svg>
                                </span>
                            </a>
                                <h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1>
                        </div>
                    </div>
                </div>

                <div class="header-container1 justify-content-center">
                    <div class="from__bx mt-4">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                                                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                                                </svg>
                                                <span class="d-none d-sm-block">Registered With School</span>
                                            </label>

                                            <!-- Export Button -->
                                            <button id="enableExportBtn" type="button" class="btn btn-secondary btn-sm d-flex align-items-center" style="gap:5px; display:none !important;">
                                                <img src="https://nep.goforfit.in/public/assets/imgs/export.svg">
                                                <span class="d-none d-sm-block trainer-action-btn">Export</span>
                                            </button>


                                            <label class="btn btn-secondary btn-sm d-flex align-items-center" style="gap:5px;">
                                                <input type="radio" name="options" id="option2" autocomplete="off"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                                                </svg>
                                                <span class="d-none d-sm-block">Add Viewer</span>
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
                                                     <th>Viewer ID</th>
                                                     <th width="150px;">Name</th>
                                                     <th>Email</th>
                                                     <th>Phone</th>
                                                     <th>Assigned Module</th>
                                                     <th >Designation</th>
                                                     <th>Status</th>
                                                     <th width="90px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count = 1 ;?>
                                                    <?php $__currentLoopData = $schoolUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $users): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr data-userid="<?php echo e($users->id); ?>">
                                                        <td><?php echo e($count++); ?></td>
                                                        <td><?php echo e($users->userid ?? 'N/A'); ?></td>
                                                        <td><?php echo e($users->name); ?></td>
                                                        <td><?php echo e($users->email); ?></td>
                                                        <td><?php echo e($users->phone); ?></td>
                                                        <td>
                                                            <?php $__currentLoopData = explode(',', $users->module_names); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="badge text-light m-1" style="background:#563d7c; font-size: 13px;  font-weight: 500;"><?php echo e(trim($module)); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </td>

                                                        <!-- <td><?php echo e($users->dob ?? ''); ?></td> -->
                                                        <td><?php echo e($users->position); ?></td>

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

                                                                data-id="<?php echo e($users->id); ?>"
                                                            >
                                                        </td>


                                                        <td>
                                                            
                                                            <a href="#" 
                                                               data-users-id="<?php echo e($users->id); ?>"
                                                               data-action="edit"
                                                               class="trainer-action-btn ">
                                                               Edit |
                                                            </a>                                                          
                                                                                                                
                                                            <a href="#" 
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
                                        <?php echo $__env->make('auth.self_registration.add-school-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
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
        <h5 class="modal-title">Edit viewer details</h5>
        <!-- Proper close button -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $__env->make('auth.self_registration.edit-school-user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                // When Add Viewer selected
                $('#schoolUsersForm').show();
                $('#schoolUsersList').hide();
            $('#enableExportBtn')[0].style.setProperty('display', 'none', 'important');
            } else if ($('#option1').is(':checked')) {
                // When Registered With School selected
                $('#schoolUsersForm').hide();
                $('#schoolUsersList').show();
                $('#enableExportBtn').css('display', 'inline-block');
            }
        }

        // Watch radio changes
        $('input[name="options"]').on('change', toggleSections);

        // Initial state on page load
        $('#enableExportBtn').hide();
        toggleSections();
    });


    $('#enableExportBtn').on('click', function() {
        // Collect all user IDs from the table
        var schoolUserIds = [];
        $('#schoolUsersList tbody tr').each(function() {
            var userid = $(this).data('userid');
            if(userid) schoolUserIds.push(userid);
        });

        if(schoolUserIds.length === 0) {
            alert('No users to export!');
            return;
        }

        $.ajax({
            url: "<?php echo e(route('export.school.users')); ?>",
            type: "POST",
            data: { school_user_ids: schoolUserIds, export_type: 'excel' },
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            xhrFields: { responseType: 'blob' }, // important for downloading file
            success: function(blob) {
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "school-users.xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(err) {
                console.error(err);
                alert('Error generating Excel');
            }
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


    $(document).on('change', '.trainer-action-btn', function(e) {
        if (ignoreChange) return;
        
        e.preventDefault();

        let $checkbox = $(this);
        let id = $checkbox.data('id');
        let action = $checkbox.prop('checked') ? 'activate' : 'deactivate';

        checkAction(id, action, $checkbox);

    });
    const schoolUsers = <?php echo json_encode($schoolUsers, 15, 512) ?>;
    function checkAction(id, action, $checkbox = null){
        let actionText = '';

        switch (action) {
            case 'activate': actionText = 'activate this user'; break;
            case 'deactivate': actionText = 'deactivate this user'; break;
            case 'delete': actionText = 'delete this user'; break;
            case 'edit': actionText = 'edit viewer details'; break;
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
            url: "<?php echo e(route('users.action')); ?>",
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
<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/school/users/school-users.blade.php ENDPATH**/ ?>

<div class="modal fade" id="testHistoryModal" tabindex="-1" role="dialog" aria-labelledby="testHistoryModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-xl modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Upload History</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>

        <div class="modal-body">
                <p>
                <strong>Note:</strong> Upload history is retained for <strong>7 days</strong> only.  
                After 7 days, all upload history will be permanently deleted from the system.  
                Please ensure that the uploaded file and the uploaded data are correct.
            </p>
        </div>

        <?php if($logs->isNotEmpty()): ?>   
        <div class="row m-1">
            <div class="col">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="3%">#</th>
                            <th width="12%">Uploaded By</th>
                            <th width="15%">Upload Time</th>
                            <th width="8%">Status</th>
                            <th width="27%">Message</th>
                            <th width="15%">Completed At</th>
                            <th width="10%">Uploaded File</th>
                            <th width="10%">Error File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($log->user->name ?? 'N/A'); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($log->created_at)->format('d M Y h:i A')); ?></td>
                            <td>
                                <?php if($log->status === 'completed'): ?>
                                    <span class="badge bg-success" style="color:#ffffff;">Completed</span>
                                <?php elseif($log->status === 'processing'): ?>
                                    <span class="badge bg-warning text-dark" style="color:#ffffff;">Processing</span>
                                <?php elseif($log->status === 'queued'): ?>
                                    <span class="badge bg-info text-dark" style="color:#ffffff;">Queued</span>
                                <?php else: ?>
                                    <span class="badge bg-danger" style="color:#ffffff;">Failed</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo nl2br(e($log->message)); ?></td>
                            <td><?php echo e($log->completed_at ? \Carbon\Carbon::parse($log->completed_at)->format('d M Y h:i A') : '-'); ?></td>
                            
                                <td style="text-align: center;">
                                <?php if($log->file_path): ?>
                                    <a href="<?php echo e(route('download.testuploadedfile', $log->id)); ?>" class="btn btn-sm btn-primary">View</a>
                                <?php endif; ?>
                            </td>

                            <td style="text-align: center;">
                                    <?php if($log->error_file): ?>
                                        <a href="<?php echo e(route('download.testerrorfile', $log->id)); ?>" class="btn btn-sm btn-primary">View</a>
                                    <?php endif; ?>                      
                            </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/modals/test-history-modal.blade.php ENDPATH**/ ?>
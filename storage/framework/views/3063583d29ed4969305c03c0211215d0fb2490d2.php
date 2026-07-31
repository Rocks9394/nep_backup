<?php if($logs->isEmpty()): ?>
    <p class="text-center">No promotion history found</p>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Total Students</th>
                <th>Promoted</th>
                <th>Transferred</th>
                <th>Status</th>
                <th>Updated At</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($log->total_students); ?></td>
                    <td><?php echo e($log->promoted_students); ?></td>
                    <td><?php echo e($log->transferred_students); ?></td>

                    <td>
                        <?php if($log->status === 'promoted'): ?>
                            <span class="badge bg-success" style="color:#ffffff;">Completed</span>
                        <?php elseif($log->status === 'processing'): ?>
                            <span class="badge bg-warning text-dark" style="color:#ffffff;">Processing</span>
                        <?php elseif($log->status === 'pending'): ?>
                            <span class="badge bg-info text-dark" style="color:#ffffff;">Queued</span>
                        <?php else: ?>
                            <span class="badge bg-danger" style="color:#ffffff;">Failed</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php echo e($log->completed_at 
                            ? \Carbon\Carbon::parse($log->completed_at)->format('d M Y h:i A') 
                            : (\Carbon\Carbon::parse($log->updated_at)->format('d M Y h:i A') ?? '-')); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/modals/students-promotion-status-table.blade.php ENDPATH**/ ?>
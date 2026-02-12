 <div class="mb-3">
     <strong>Note:</strong>
    Generated reports are retained for <strong>7 days</strong> only. After 7 days, they will be permanently deleted from the system. Please download and store your reports before they expire. 
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Request Date & Time</th>
            <th>Total Reports Requested</th>
            <th>Reports Generated</th>
            <th>Current Status</th>
            <th>Action</th>
            <th>Expires At</th>
        </tr>
    </thead>
    <tbody>


    <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(\Carbon\Carbon::parse($report->created_at)->format('d-m-Y h:i A')); ?></td>
            <td><?php echo e($report->total_students); ?></td>
            <td><?php echo e($report->completed_students); ?> / <?php echo e($report->total_students); ?></td>
            <td>
                <?php if($report->status === 'completed'): ?>
                    <span class="badge bg-success" style="color:#ffffff;">Completed</span>
                <?php elseif($report->status === 'in_progress'): ?>
                    <span class="badge bg-warning text-dark" style="color:#ffffff;">Processing</span>
                <?php elseif($report->status === 'failed'): ?>
                    <span class="badge bg-danger">Failed</span>
                 <?php elseif($report->status === 'pending'): ?>
                    <span class="badge bg-danger">Pending</span>
                <?php else: ?>
                    <span class="badge bg-secondary" style="color:#ffffff;">Requested</span>
                <?php endif; ?>
            </td>

            <td>
                <?php if($report->status === 'completed'): ?>
                    <!-- <a href="<?php echo e($report->download_path); ?>" class="btn btn-sm btn-primary"> Ready to Download </a> -->
                    <a href="<?php echo e(isset($type) && $type === 'skill' ? route('skill.reports.download', $report->id) : $report->download_path); ?>" class="btn btn-sm btn-primary"> Ready to Download </a>
                <?php else: ?>
                    <button class="btn btn-sm btn-secondary" disabled>
                        Not Ready
                    </button>
                <?php endif; ?>
            </td>

            <td>
                <?php if($report->expires_at): ?>
                    <?php
                        $expiresAt = \Carbon\Carbon::parse($report->expires_at);
                    ?>

                    <?php if(now()->lessThan($expiresAt)): ?>
                        <span class="text-success">
                            Available until:
                            <strong><?php echo e($expiresAt->format('d M Y')); ?></strong>
                        </span>
                        <br>
                        <small class="text-muted">
                            Expires in <?php echo e(now()->diffInDays($expiresAt)); ?> day(s)
                        </small>
                    <?php else: ?>
                        <span class="text-danger">
                            Download expired on <?php echo e($expiresAt->format('d M Y')); ?>

                        </span>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="text-muted">Not Ready</span>
                <?php endif; ?>
            </td>


        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/modals/available-report-cards.blade.php ENDPATH**/ ?>
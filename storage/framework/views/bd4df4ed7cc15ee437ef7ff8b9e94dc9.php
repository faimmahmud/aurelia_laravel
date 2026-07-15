

<?php ($pageTitle = 'Manage Bookings | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top">
  <div class="container">
    <div class="section-kicker">Admin</div>
    <h1 class="section-title mb-4">All bookings</h1>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Customer</th>
            <th>Package</th>
            <th>Guests</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Update</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($b->booking_ref); ?></td>
            <td><?php echo e($b->customer_name); ?><br><span class="text-muted small"><?php echo e($b->customer_email); ?> / <?php echo e($b->customer_phone); ?></span></td>
            <td><?php echo e($b->package_name); ?></td>
            <td><?php echo e($b->guests); ?></td>
            <td><?php echo e($b->currency); ?> <?php echo e(number_format($b->amount, 2)); ?></td>
            <td><span class="badge bg-<?php echo e($b->paymentBadgeClass()); ?>"><?php echo e($b->payment_status); ?></span></td>
            <td><span class="badge bg-<?php echo e($b->statusBadgeClass()); ?>"><?php echo e($b->booking_status); ?></span></td>
            <td>
              <a href="<?php echo e(route('admin.bookings.show', $b->id)); ?>" class="btn btn-sm btn-outline-dark mb-1">View</a>
              <form action="<?php echo e(route('admin.bookings.update', $b->id)); ?>" method="post" class="d-flex gap-1">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <select name="booking_status" class="form-select form-select-sm">
                  <?php $__currentLoopData = ['pending_review','confirmed','cancelled','rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php if($b->booking_status === $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button class="btn btn-sm btn-gold">Save</button>
              </form>
            </td>
            <td>
              <form action="<?php echo e(route('admin.bookings.destroy', $b->id)); ?>" method="post" onsubmit="return confirm('Delete this booking?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="9" class="text-center text-muted py-4">No bookings yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php echo e($bookings->links()); ?>

  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/bookings.blade.php ENDPATH**/ ?>
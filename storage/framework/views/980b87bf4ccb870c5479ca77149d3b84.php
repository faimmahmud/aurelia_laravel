

<?php ($pageTitle = 'Booking ' . $booking->booking_ref . ' | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <div class="section-kicker">Admin</div>
        <h1 class="section-title mb-0">Booking <?php echo e($booking->booking_ref); ?></h1>
      </div>
      <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-outline-dark px-4">Back to bookings</a>
    </div>

    <div class="row g-4">
      <div class="col-lg-7">
        <div class="form-shell p-4 p-lg-5 reveal">
          <h2 class="h5 mb-3">Trip details</h2>
          <dl class="row mb-0">
            <dt class="col-5 text-muted">Package</dt><dd class="col-7"><?php echo e($booking->package_name); ?></dd>
            <dt class="col-5 text-muted">Country</dt><dd class="col-7"><?php echo e($booking->country ?: '—'); ?></dd>
            <dt class="col-5 text-muted">Travel date</dt><dd class="col-7"><?php echo e($booking->travel_date); ?> <?php echo e($booking->travel_time); ?></dd>
            <dt class="col-5 text-muted">Return date</dt><dd class="col-7"><?php echo e($booking->leave_date); ?> <?php echo e($booking->leave_time); ?></dd>
            <dt class="col-5 text-muted">Guests</dt><dd class="col-7"><?php echo e($booking->guests); ?></dd>
            <dt class="col-5 text-muted">Message</dt><dd class="col-7"><?php echo e($booking->message ?: '—'); ?></dd>
          </dl>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Customer</h2>
          <dl class="row mb-0">
            <dt class="col-5 text-muted">Name</dt><dd class="col-7"><?php echo e($booking->customer_name); ?></dd>
            <dt class="col-5 text-muted">Email</dt><dd class="col-7"><?php echo e($booking->customer_email); ?></dd>
            <dt class="col-5 text-muted">Phone</dt><dd class="col-7"><?php echo e($booking->customer_phone); ?></dd>
            <dt class="col-5 text-muted">Booked by</dt><dd class="col-7"><?php echo e($booking->booked_by); ?> (<?php echo e($booking->booked_role); ?>)</dd>
            <dt class="col-5 text-muted">IP / agent</dt><dd class="col-7"><?php echo e($booking->ip_address); ?><br><span class="small text-muted"><?php echo e($booking->user_agent); ?></span></dd>
          </dl>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Activity log</h2>
          <?php $__empty_1 = true; $__currentLoopData = $booking->auditLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border-bottom py-2 small">
              <strong><?php echo e($log->action_type); ?></strong>
              <?php if($log->old_status || $log->new_status): ?>
                — <?php echo e($log->old_status ?: '—'); ?> → <?php echo e($log->new_status ?: '—'); ?>

              <?php endif; ?>
              <span class="text-muted"> by <?php echo e($log->actor_email ?: 'system'); ?> (<?php echo e($log->actor_role); ?>)</span>
              <div class="text-muted"><?php echo e($log->created_at); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted small mb-0">No activity recorded yet.</p>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="form-shell p-4 p-lg-5 reveal">
          <h2 class="h5 mb-3">Payment & status</h2>
          <dl class="row mb-3">
            <dt class="col-6 text-muted">Amount</dt><dd class="col-6"><?php echo e($booking->currency); ?> <?php echo e(number_format($booking->amount, 2)); ?></dd>
            <dt class="col-6 text-muted">Payment method</dt><dd class="col-6"><?php echo e($booking->payment_method); ?></dd>
            <dt class="col-6 text-muted">Payment reference</dt><dd class="col-6"><?php echo e($booking->payment_reference ?: '—'); ?></dd>
            <dt class="col-6 text-muted">Payment status</dt><dd class="col-6"><span class="badge bg-<?php echo e($booking->paymentBadgeClass()); ?>"><?php echo e($booking->payment_status); ?></span></dd>
            <dt class="col-6 text-muted">Booking status</dt><dd class="col-6"><span class="badge bg-<?php echo e($booking->statusBadgeClass()); ?>"><?php echo e($booking->booking_status); ?></span></dd>
          </dl>

          <form action="<?php echo e(route('admin.bookings.update', $booking->id)); ?>" method="post" class="row g-2">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="col-8">
              <select name="booking_status" class="form-select">
                <?php $__currentLoopData = ['pending_review','confirmed','cancelled','rejected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($status); ?>" <?php if($booking->booking_status === $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>
            <div class="col-4">
              <button class="btn btn-gold w-100">Update</button>
            </div>
          </form>

          <form action="<?php echo e(route('admin.bookings.destroy', $booking->id)); ?>" method="post" class="mt-3" onsubmit="return confirm('Delete this booking?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn btn-outline-danger w-100">Delete booking</button>
          </form>
        </div>

        <div class="form-shell p-4 p-lg-5 reveal mt-4">
          <h2 class="h5 mb-3">Notifications sent</h2>
          <?php $__empty_1 = true; $__currentLoopData = $booking->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border-bottom py-2 small">
              <strong><?php echo e($n->title); ?></strong>
              <div class="text-muted"><?php echo e($n->body); ?></div>
              <div class="text-muted"><?php echo e($n->created_at); ?> · <?php echo e($n->status); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted small mb-0">No notifications yet.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/booking-view.blade.php ENDPATH**/ ?>
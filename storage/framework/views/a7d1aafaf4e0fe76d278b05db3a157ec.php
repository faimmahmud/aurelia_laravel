

<?php ($pageTitle = 'My Dashboard | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top">
  <div class="container">
    <div class="section-kicker">Account</div>
    <h1 class="section-title mb-4">Welcome, <?php echo e(auth()->user()->name); ?></h1>

    <?php ($myBookings = \App\Models\Booking::where('customer_email', auth()->user()->email)->latest()->get()); ?>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Package</th>
            <th>Travel date</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $myBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($b->booking_ref); ?></td>
            <td><?php echo e($b->package_name); ?></td>
            <td><?php echo e($b->travel_date); ?></td>
            <td><?php echo e($b->currency); ?> <?php echo e(number_format($b->amount, 2)); ?></td>
            <td><span class="badge bg-<?php echo e($b->paymentBadgeClass()); ?>"><?php echo e($b->payment_status); ?></span></td>
            <td><span class="badge bg-<?php echo e($b->statusBadgeClass()); ?>"><?php echo e($b->booking_status); ?></span></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">You haven't made a booking yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>

    <a href="<?php echo e(route('booking.create')); ?>" class="btn btn-gold px-4 mt-3">Book a new trip</a>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\trash\aurelia_laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<div class="section-kicker">Admin</div>
<h1 class="section-title mb-4">Control center</h1>


<div class="row g-3 mb-3">
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Total bookings</span>
        <span class="stat-icon"><i class="fa-solid fa-suitcase-rolling"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['total']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Pending review</span>
        <span class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['pending']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Confirmed</span>
        <span class="stat-icon"><i class="fa-solid fa-check-double"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['confirmed']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Revenue (paid)</span>
        <span class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></span>
      </div>
      <div class="fs-3 fw-bold">$<?php echo e(number_format($stats['revenue'], 2)); ?></div>
    </div>
  </div>
</div>


<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Users</span>
        <span class="stat-icon"><i class="fa-solid fa-users"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['users']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Countries</span>
        <span class="stat-icon"><i class="fa-solid fa-globe"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['countries']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Destinations</span>
        <span class="stat-icon"><i class="fa-solid fa-earth-asia"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['destinations']); ?></div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="text-muted small text-uppercase">Packages</span>
        <span class="stat-icon"><i class="fa-solid fa-box-open"></i></span>
      </div>
      <div class="fs-3 fw-bold"><?php echo e($stats['packages']); ?></div>
    </div>
  </div>
</div>


<h6 class="text-uppercase text-muted small letter-wide mb-3">Manage</h6>
<div class="row g-3 mb-4">
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.users.index')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-users"></i></span>
      <div>
        <div class="fw-bold">Users</div>
        <div class="small text-muted">Roles & accounts</div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.countries.index')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-globe"></i></span>
      <div>
        <div class="fw-bold">Countries</div>
        <div class="small text-muted">Manage country list</div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.destinations.index')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-earth-asia"></i></span>
      <div>
        <div class="fw-bold">Destinations</div>
        <div class="small text-muted">Curated locations</div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.packages')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-suitcase"></i></span>
      <div>
        <div class="fw-bold">Packages</div>
        <div class="small text-muted">Tour packages</div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.bookings')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-calendar-check"></i></span>
      <div>
        <div class="fw-bold">Bookings</div>
        <div class="small text-muted">All reservations</div>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="<?php echo e(route('admin.settings.branding')); ?>" class="quick-link">
      <span class="qi"><i class="fa-solid fa-palette"></i></span>
      <div>
        <div class="fw-bold">Branding & Contact</div>
        <div class="small text-muted">Site settings</div>
      </div>
    </a>
  </div>
</div>


<div class="d-flex justify-content-between align-items-center mb-3">
  <h6 class="text-uppercase text-muted small letter-wide mb-0">Recent bookings</h6>
  <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">View all bookings</a>
</div>

<div class="card">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Ref</th>
          <th>Customer</th>
          <th>Package</th>
          <th>Travel date</th>
          <th>Amount</th>
          <th>Payment</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($b->booking_ref); ?></td>
          <td><?php echo e($b->customer_name); ?><br><span class="text-muted small"><?php echo e($b->customer_email); ?></span></td>
          <td><?php echo e($b->package_name); ?></td>
          <td><?php echo e($b->travel_date); ?></td>
          <td><?php echo e($b->currency); ?> <?php echo e(number_format($b->amount, 2)); ?></td>
          <td><span class="badge bg-<?php echo e($b->paymentBadgeClass()); ?>"><?php echo e($b->payment_status); ?></span></td>
          <td><span class="badge bg-<?php echo e($b->statusBadgeClass()); ?>"><?php echo e($b->booking_status); ?></span></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7" class="text-center text-muted py-4">No bookings yet.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="mt-3">
  <?php echo e($bookings->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
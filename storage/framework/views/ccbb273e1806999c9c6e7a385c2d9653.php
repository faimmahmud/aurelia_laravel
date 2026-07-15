<?php ($pageTitle = 'My Dashboard | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top">
  <div class="container">

    <div class="section-kicker">Account</div>
    <h1 class="section-title mb-1">Welcome back, <?php echo e(auth()->user()->name); ?></h1>
    <p class="text-muted mb-4">Here's a full summary of your Aurelia Travel account.</p>

    
    <div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light h-100">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="text-muted small text-uppercase">Total bookings</div>
            <i class="bi bi-suitcase2 text-gold fs-5"></i>
          </div>
          <div class="fs-3 fw-bold"><?php echo e($stats['total']); ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light h-100">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="text-muted small text-uppercase">Upcoming trips</div>
            <i class="bi bi-calendar-event text-gold fs-5"></i>
          </div>
          <div class="fs-3 fw-bold"><?php echo e($stats['upcoming']); ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light h-100">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="text-muted small text-uppercase">Confirmed</div>
            <i class="bi bi-check2-circle text-gold fs-5"></i>
          </div>
          <div class="fs-3 fw-bold"><?php echo e($stats['confirmed']); ?></div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="p-4 rounded-4 border bg-light h-100">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div class="text-muted small text-uppercase">Total spent</div>
            <i class="bi bi-wallet2 text-gold fs-5"></i>
          </div>
          <div class="fs-3 fw-bold"><?php echo e(number_format($stats['spent'], 2)); ?></div>
        </div>
      </div>
    </div>

    
    <?php if($nextTrip): ?>
      <div class="p-4 p-lg-5 rounded-4 mb-4 text-white" style="background:linear-gradient(120deg,#0f1b3d,#1b1730);">
        <div class="row align-items-center g-3">
          <div class="col-lg-7">
            <div class="text-uppercase small text-gold letter-wide mb-1">Your next trip</div>
            <h3 class="fw-bold mb-2"><?php echo e($nextTrip->package_name ?? $nextTrip->destination); ?></h3>
            <div class="text-white-50">
              <i class="bi bi-geo-alt"></i> <?php echo e($nextTrip->destination); ?>

              &nbsp;•&nbsp;
              <i class="bi bi-calendar3"></i> <?php echo e($nextTrip->travel_date); ?>

              &nbsp;•&nbsp;
              <i class="bi bi-people"></i> <?php echo e($nextTrip->guests); ?> guest(s)
            </div>
          </div>
          <div class="col-lg-2 text-center">
            <?php if(!is_null($daysToNextTrip)): ?>
              <div class="fs-1 fw-bold text-gold lh-1"><?php echo e($daysToNextTrip); ?></div>
              <div class="small text-white-50 text-uppercase letter-wide">days to go</div>
            <?php endif; ?>
          </div>
          <div class="col-lg-3 text-lg-end">
            <span class="badge bg-<?php echo e($nextTrip->statusBadgeClass()); ?> mb-2"><?php echo e(ucfirst(str_replace('_',' ',$nextTrip->booking_status))); ?></span><br>
            <span class="fs-4 fw-bold text-gold"><?php echo e($nextTrip->currency); ?> <?php echo e(number_format($nextTrip->amount, 2)); ?></span>
          </div>
        </div>
      </div>
    <?php endif; ?>

    
    <div class="row g-3 mb-4">
      <div class="col-lg-7">
        <div class="p-4 rounded-4 border h-100">
          <h6 class="text-uppercase text-muted small letter-wide mb-3">Spend, last 6 months</h6>
          <div class="d-flex align-items-end gap-2" style="height:140px;">
            <?php $__currentLoopData = $monthlySpend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php ($h = $maxMonthlySpend > 0 ? max(4, ($m['total'] / $maxMonthlySpend) * 120) : 4); ?>
              <div class="flex-fill text-center">
                <div class="mx-auto rounded-top" title="<?php echo e(number_format($m['total'], 2)); ?>"
                     style="width:70%;height:<?php echo e($h); ?>px;background:linear-gradient(180deg,#d4af37,#ffe28a);"></div>
                <div class="small text-muted mt-2"><?php echo e($m['label']); ?></div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="p-4 rounded-4 border h-100">
          <h6 class="text-uppercase text-muted small letter-wide mb-3">Status breakdown</h6>
          <?php $__empty_1 = true; $__currentLoopData = $statusBreakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="mb-2">
              <div class="d-flex justify-content-between small mb-1">
                <span><?php echo e(ucfirst(str_replace('_',' ',$status))); ?></span>
                <span class="text-muted"><?php echo e($count); ?></span>
              </div>
              <div class="progress" style="height:8px;">
                <div class="progress-bar" role="progressbar"
                     style="width:<?php echo e(($count / $maxStatusCount) * 100); ?>%;background:#d4af37;"></div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-muted small mb-0">No bookings yet.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <?php if($topDestinations->count()): ?>
      <div class="p-4 rounded-4 border mb-4">
        <h6 class="text-uppercase text-muted small letter-wide mb-3">Your favorite destinations</h6>
        <div class="d-flex flex-wrap gap-2">
          <?php $__currentLoopData = $topDestinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="badge rounded-pill border text-dark px-3 py-2">
              <i class="bi bi-geo-alt text-gold"></i> <?php echo e($destination); ?>

              <span class="text-muted">× <?php echo e($count); ?></span>
            </span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endif; ?>

    
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h5 mb-0">Booking history</h2>
      <a href="<?php echo e(route('booking.create')); ?>" class="btn btn-gold btn-sm rounded-pill px-3">Book a new trip</a>
    </div>

    <div class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" id="bookingSearch" class="form-control" placeholder="Search by ref, package or destination...">
      </div>
      <div class="col-md-3">
        <select id="bookingStatusFilter" class="form-select">
          <option value="">All statuses</option>
          <option value="confirmed">Confirmed</option>
          <option value="pending_review">Pending review</option>
          <option value="cancelled">Cancelled</option>
          <option value="rejected">Rejected</option>
        </select>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table align-middle" id="bookingTable">
        <thead>
          <tr>
            <th>Ref</th>
            <th>Package</th>
            <th>Destination</th>
            <th>Travel date</th>
            <th>Amount</th>
            <th>Payment</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr data-status="<?php echo e($b->booking_status); ?>"
              data-search="<?php echo e(strtolower($b->booking_ref.' '.$b->package_name.' '.$b->destination)); ?>">
            <td><?php echo e($b->booking_ref); ?></td>
            <td><?php echo e($b->package_name); ?></td>
            <td><?php echo e($b->destination); ?></td>
            <td><?php echo e($b->travel_date); ?></td>
            <td><?php echo e($b->currency); ?> <?php echo e(number_format($b->amount, 2)); ?></td>
            <td><span class="badge bg-<?php echo e($b->paymentBadgeClass()); ?>"><?php echo e($b->payment_status); ?></span></td>
            <td><span class="badge bg-<?php echo e($b->statusBadgeClass()); ?>"><?php echo e($b->booking_status); ?></span></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="7" class="text-center text-muted py-4">You haven't made a booking yet.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
      <p class="text-center text-muted small py-3 d-none" id="noResultsRow">No bookings match your filters.</p>
    </div>

    <div class="d-flex justify-content-center">
      <?php echo e($bookings->links()); ?>

    </div>

    
    <div class="row g-3 mt-4">
      <div class="col-lg-6">
        <div class="p-4 rounded-4 border h-100">
          <h6 class="text-uppercase text-muted small letter-wide mb-3">Account details</h6>
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                 style="width:56px;height:56px;background:linear-gradient(135deg,#0f1b3d,#1b1730);">
              <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>
            <div>
              <div class="fw-bold"><?php echo e(auth()->user()->name); ?></div>
              <div class="text-muted small"><?php echo e(auth()->user()->email); ?></div>
            </div>
          </div>
          <p class="mb-0"><strong>Member since:</strong> <?php echo e(auth()->user()->created_at->format('F Y')); ?></p>
          <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3 mt-3">Edit profile</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="p-4 rounded-4 border h-100">
          <h6 class="text-uppercase text-muted small letter-wide mb-3">Quick actions</h6>
          <div class="d-flex flex-wrap gap-2">
            <a href="<?php echo e(route('booking.create')); ?>" class="btn btn-gold btn-sm rounded-pill px-3">New booking</a>
            <a href="<?php echo e(route('packages')); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">Browse packages</a>
            <a href="<?php echo e(route('destinations')); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">Explore destinations</a>
            <a href="<?php echo e(route('world')); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">World explorer</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var search = document.getElementById('bookingSearch');
  var statusFilter = document.getElementById('bookingStatusFilter');
  var rows = document.querySelectorAll('#bookingTable tbody tr[data-status]');
  var noResults = document.getElementById('noResultsRow');

  function applyFilters() {
    var term = (search.value || '').toLowerCase().trim();
    var status = statusFilter.value;
    var visible = 0;

    rows.forEach(function (row) {
      var matchesTerm = !term || row.getAttribute('data-search').indexOf(term) !== -1;
      var matchesStatus = !status || row.getAttribute('data-status') === status;
      var show = matchesTerm && matchesStatus;
      row.style.display = show ? '' : 'none';
      if (show) visible++;
    });

    noResults.classList.toggle('d-none', visible !== 0);
  }

  if (search) search.addEventListener('input', applyFilters);
  if (statusFilter) statusFilter.addEventListener('change', applyFilters);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/dashboard.blade.php ENDPATH**/ ?>
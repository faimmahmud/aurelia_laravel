<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e($pageTitle ?? ($site['brand'] ?? 'Aurelia Travel')); ?></title>
  <meta name="description" content="Premium tourism website with full-screen luxury design and smooth animations.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
</head>
<body>
<div class="cursor" aria-hidden="true"></div>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top luxury-nav">
  <div class="container-fluid px-4 px-lg-5">
    <a class="navbar-brand fw-bold text-uppercase letter-wide" href="<?php echo e(route('home')); ?>"><?php echo e($site['brand'] ?? 'Aurelia Travel'); ?></a>
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="topNav">
      <ul class="navbar-nav mx-auto gap-lg-2">
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('destinations')); ?>">Destinations</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('packages')); ?>">Tour Packages</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('world')); ?>">World Explorer</a></li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo e(auth()->check() ? route('booking.create') : route('login')); ?>">Booking</a>
        </li>
        <?php if(auth()->guard()->check()): ?>
          <?php if(auth()->user()->role === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.bookings')); ?>">Bookings</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo e(route('admin.packages')); ?>">Packages</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <div class="d-flex gap-2 align-items-center">
        <?php if(auth()->guard()->check()): ?>
          <div class="nav-user">
            <span class="small text-white-50">Welcome</span>
            <strong class="d-block"><?php echo e(auth()->user()->name); ?></strong>
          </div>
          <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-light btn-sm rounded-pill px-3">Logout</button>
          </form>
        <?php else: ?>
          <a class="btn btn-outline-light btn-sm rounded-pill px-3" href="<?php echo e(route('login')); ?>">Login</a>
          <a class="btn btn-gold btn-sm rounded-pill px-3" href="<?php echo e(route('register')); ?>">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<?php if(session('success')): ?>
<div class="container pt-3">
  <div class="alert alert-success shadow-sm rounded-4 mb-0"><?php echo e(session('success')); ?></div>
</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="container pt-3">
  <div class="alert alert-danger shadow-sm rounded-4 mb-0"><?php echo e(session('error')); ?></div>
</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="container pt-3">
  <div class="alert alert-danger shadow-sm rounded-4 mb-0">
    <ul class="mb-0">
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</div>
<?php endif; ?>

<main>
<?php echo $__env->yieldContent('content'); ?>
</main>

<footer class="site-footer mt-5">
  <div class="container py-5">
    <div class="row gy-4">
      <div class="col-lg-5">
        <h3 class="fw-bold text-white mb-3"><?php echo e($site['brand'] ?? 'Aurelia Travel'); ?></h3>
        <p class="text-white-50 mb-0">A premium tourism experience with cinematic visuals, elegant motion, and a clean luxury feel.</p>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="text-uppercase text-white-50 letter-wide">Explore</h6>
        <ul class="list-unstyled footer-links">
          <li><a href="<?php echo e(route('destinations')); ?>">Destinations</a></li>
          <li><a href="<?php echo e(route('packages')); ?>">Packages</a></li>
          <li><a href="<?php echo e(route('world')); ?>">World Explorer</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h6 class="text-uppercase text-white-50 letter-wide">Account</h6>
        <ul class="list-unstyled footer-links">
          <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
          <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
          <li><a href="<?php echo e(route('booking.create')); ?>">Booking</a></li>
        </ul>
      </div>
      <div class="col-lg-3">
        <h6 class="text-uppercase text-white-50 letter-wide">Newsletter</h6>
        <p class="text-white-50">Premium travel updates and featured destinations.</p>
        <form class="newsletter-form">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Email address">
            <button class="btn btn-gold" type="button">Join</button>
          </div>
        </form>
      </div>
    </div>
    <hr class="border-white border-opacity-10 my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 text-white-50 small">
      <span>&copy; <?php echo e(date('Y')); ?> <?php echo e($site['brand'] ?? 'Aurelia Travel'); ?>. All rights reserved.</span>
      <span>Luxury arc-style tourism website.</span>
    </div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\faim\laravel\aurelia_laravel\resources\views/layouts/master.blade.php ENDPATH**/ ?>
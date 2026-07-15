

<?php ($pageTitle = 'Register | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('<?php echo e(e(\App\Support\TravelData::img('register-visual'))); ?>')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">New account</span>
          <h2 class="display-5 fw-bold mt-3">Start your luxury journey</h2>
          <p class="mb-0 text-white-50">Register to save bookings and access premium travel experiences.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Register</div>
      <h1 class="section-title mb-3">Create account</h1>

      <form method="post" action="<?php echo e(route('register')); ?>" class="mt-4 row g-3">
        <?php echo csrf_field(); ?>
        <div class="col-12">
          <label class="form-label">Full name</label>
          <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required autofocus>
        </div>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
        </div>
        <div class="col-12">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="form-label">Confirm password</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
          <button class="btn btn-gold px-4" type="submit">Register</button>
          <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-dark px-4">Login</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>
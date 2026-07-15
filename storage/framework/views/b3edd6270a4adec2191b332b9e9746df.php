

<?php ($pageTitle = 'Login | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('<?php echo e(e(\App\Support\TravelData::img('login-visual'))); ?>')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">Secure access</span>
          <h2 class="display-5 fw-bold mt-3">Enter the concierge space</h2>
          <p class="mb-0 text-white-50">Luxury bookings, admin tools, and premium content management.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Login</div>
      <h1 class="section-title mb-3">Welcome back</h1>
      <p class="section-lead">Use your registered account to continue.</p>

      <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-3','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-3','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

      <form method="post" action="<?php echo e(route('login')); ?>" class="mt-4 row g-3">
        <?php echo csrf_field(); ?>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>
        <div class="col-12">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-12">
          <label class="d-flex align-items-center gap-2">
            <input type="checkbox" name="remember"> <span class="small text-muted">Remember me</span>
          </label>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
          <button class="btn btn-gold px-4" type="submit">Login</button>
          <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-dark px-4">Create account</a>
          <?php if(Route::has('password.request')): ?>
            <a href="<?php echo e(route('password.request')); ?>" class="small text-muted ms-2">Forgot password?</a>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>
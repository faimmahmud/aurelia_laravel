

<?php ($pageTitle = 'Forgot Password | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-wrap">
  <div class="login-panel">
    <div class="login-visual" style="background-image:url('<?php echo e(e(\App\Support\TravelData::img('forgot-password-visual'))); ?>')">
      <div class="position-relative z-2 h-100 d-flex align-items-end p-4 p-lg-5">
        <div class="text-white">
          <span class="hero-kicker">Account recovery</span>
          <h2 class="display-5 fw-bold mt-3">Forgot your password?</h2>
          <p class="mb-0 text-white-50">We'll email you a link to choose a new one.</p>
        </div>
      </div>
    </div>
    <div class="login-body">
      <div class="section-kicker">Reset password</div>
      <h1 class="section-title mb-3">No problem</h1>
      <p class="section-lead">Enter your email address and we'll send you a password reset link.</p>

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

      <form method="post" action="<?php echo e(route('password.email')); ?>" class="mt-4 row g-3">
        <?php echo csrf_field(); ?>
        <div class="col-12">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>
        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit">Email password reset link</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\aurelia_laravel\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>
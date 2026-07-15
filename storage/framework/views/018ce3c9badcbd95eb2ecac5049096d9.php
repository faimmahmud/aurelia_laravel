

<?php ($pageTitle = 'Access Denied | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top text-center">
  <div class="container" style="max-width:560px;">
    <span class="hero-kicker">403</span>
    <h1 class="section-title mt-3">Access denied</h1>
    <p class="section-lead"><?php echo e($exception->getMessage() ?: "You don't have permission to view this page."); ?></p>
    <a href="<?php echo e(route('home')); ?>" class="btn btn-gold px-4 mt-3">Back to home</a>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/errors/403.blade.php ENDPATH**/ ?>
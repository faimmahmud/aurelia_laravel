<?php $__env->startSection('content'); ?>
<div class="section-kicker">Countries</div>
<h1 class="section-title mb-4">Add country</h1>

<div class="card p-4">
  <form action="<?php echo e(route('admin.countries.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('admin.countries._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-primary px-4">Save country</button>
      <a href="<?php echo e(route('admin.countries.index')); ?>" class="btn btn-outline-dark px-4">Cancel</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/countries/create.blade.php ENDPATH**/ ?>
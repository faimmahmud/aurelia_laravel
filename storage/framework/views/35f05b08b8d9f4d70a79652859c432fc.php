

<?php ($pageTitle = 'Manage Packages | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section arc-top">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <div class="section-kicker">Admin</div>
        <h1 class="section-title mb-0">Tour packages</h1>
      </div>
      <a href="<?php echo e(route('admin.packages.create')); ?>" class="btn btn-gold px-4">Add package</a>
    </div>

    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Country</th>
            <th>Price</th>
            <th>Category</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pkg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><div style="width:70px;height:50px;background-size:cover;background-position:center;border-radius:8px;background-image:url('<?php echo e($pkg->image); ?>')"></div></td>
            <td><?php echo e($pkg->title); ?></td>
            <td><?php echo e($pkg->country); ?></td>
            <td><?php echo e($pkg->price); ?></td>
            <td><?php echo e($pkg->category); ?></td>
            <td class="text-end">
              <a href="<?php echo e(route('admin.packages.edit', $pkg->id)); ?>" class="btn btn-sm btn-outline-dark">Edit</a>
              <form action="<?php echo e(route('admin.packages.destroy', $pkg->id)); ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this package?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">No packages saved yet — the public Packages page still shows the built-in catalog.</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/packages.blade.php ENDPATH**/ ?>
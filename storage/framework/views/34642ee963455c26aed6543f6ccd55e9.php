

<?php ($pageTitle = ($package ? 'Edit Package' : 'Add Package') . ' | Aurelia Travel'); ?>

<?php $__env->startSection('content'); ?>
<section class="arc-section mt-0">
  <div class="container">
    <div class="form-shell p-4 p-lg-5 reveal">
      <div class="section-kicker">Admin</div>
      <h1 class="section-title mb-3"><?php echo e($package ? 'Edit tour package' : 'Add tour package'); ?></h1>

      <form method="post" action="<?php echo e($package ? route('admin.packages.update', $package->id) : route('admin.packages.store')); ?>" enctype="multipart/form-data" class="row g-3">
        <?php echo csrf_field(); ?>
        <?php if($package): ?>
          <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="col-md-6"><input class="form-control" name="title" placeholder="Title" value="<?php echo e(old('title', $package->title ?? '')); ?>" required></div>
        <div class="col-md-6"><input class="form-control" name="country" placeholder="Country" value="<?php echo e(old('country', $package->country ?? '')); ?>"></div>
        <div class="col-md-4"><input class="form-control" name="price" placeholder="Price" value="<?php echo e(old('price', $package->price ?? '')); ?>" required></div>
        <div class="col-md-4"><input class="form-control" name="rating" placeholder="Rating" value="<?php echo e(old('rating', $package->rating ?? '5.0')); ?>"></div>
        <div class="col-md-4"><input class="form-control" name="days" placeholder="Days" value="<?php echo e(old('days', $package->days ?? '7 Days')); ?>"></div>
        <div class="col-12"><textarea class="form-control" name="description" rows="4" placeholder="Description"><?php echo e(old('description', $package->description ?? '')); ?></textarea></div>

        <div class="col-md-6">
          <label class="form-label">Image URL</label>
          <input class="form-control" name="image" placeholder="https://..." value="<?php echo e(old('image', $package->image ?? '')); ?>">
        </div>
        <div class="col-md-6">
          <label class="form-label">Or upload image</label>
          <input class="form-control" type="file" name="image_file" accept="image/*">
        </div>

        <div class="col-md-6"><input class="form-control" name="category" placeholder="Category" value="<?php echo e(old('category', $package->category ?? 'city')); ?>"></div>
        <div class="col-12">
          <label class="form-label">Features (one per line)</label>
          <textarea class="form-control" name="details" rows="4" placeholder="One feature per line"><?php echo e(old('details', $package && $package->relationLoaded('features') ? $package->features->pluck('feature')->implode("\n") : '')); ?></textarea>
        </div>

        <div class="col-12">
          <button class="btn btn-gold px-4" type="submit"><?php echo e($package ? 'Update package' : 'Save package'); ?></button>
          <a class="btn btn-outline-dark px-4" href="<?php echo e(route('admin.packages')); ?>">Back</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/package-form.blade.php ENDPATH**/ ?>
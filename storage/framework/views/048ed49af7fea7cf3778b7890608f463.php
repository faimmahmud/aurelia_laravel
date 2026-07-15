<?php $__env->startSection('content'); ?>
<div class="section-kicker">Destinations</div>
<h1 class="section-title mb-4"><?php echo e($destination ? 'Edit destination' : 'Add destination'); ?></h1>

<div class="card p-4">
  <form action="<?php echo e($destination ? route('admin.destinations.update', $destination) : route('admin.destinations.store')); ?>"
        method="POST">
    <?php echo csrf_field(); ?>
    <?php if($destination): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Destination name *</label>
        <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $destination->name ?? '')); ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Country *</label>
        <input type="text" name="country" class="form-control" value="<?php echo e(old('country', $destination->country ?? '')); ?>" required>
      </div>

      <div class="col-md-12">
        <label class="form-label">Thumbnail image URL / path</label>
        <input type="text" name="thumbnail" class="form-control" value="<?php echo e(old('thumbnail', $destination->thumbnail ?? '')); ?>" placeholder="destinations/example.jpg">
        <?php if(!empty($destination->thumbnail)): ?>
          <img src="<?php echo e(asset('storage/'.$destination->thumbnail)); ?>" class="mt-2 rounded border" width="100">
        <?php endif; ?>
      </div>

      <div class="col-12">
        <label class="form-label">Short description</label>
        <input type="text" name="short_description" class="form-control" value="<?php echo e(old('short_description', $destination->short_description ?? '')); ?>">
      </div>

      <div class="col-12">
        <label class="form-label">Full description</label>
        <textarea name="description" rows="5" class="form-control"><?php echo e(old('description', $destination->description ?? '')); ?></textarea>
      </div>

      <div class="col-md-6 form-check ps-4">
        <input type="checkbox" name="featured" id="featured" class="form-check-input"
          <?php echo e(old('featured', $destination->featured ?? false) ? 'checked' : ''); ?>>
        <label for="featured" class="form-check-label">Featured</label>
      </div>
      <div class="col-md-6 form-check ps-4">
        <input type="checkbox" name="status" id="status" class="form-check-input"
          <?php echo e(old('status', $destination->status ?? true) ? 'checked' : ''); ?>>
        <label for="status" class="form-check-label">Active (visible on site)</label>
      </div>
    </div>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-primary px-4"><?php echo e($destination ? 'Update destination' : 'Save destination'); ?></button>
      <a href="<?php echo e(route('admin.destinations.index')); ?>" class="btn btn-outline-dark px-4">Cancel</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/destinations/form.blade.php ENDPATH**/ ?>
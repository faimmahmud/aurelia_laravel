<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="section-kicker">Destinations</div>
            <h1 class="section-title mb-1">Manage destinations</h1>
            <p class="text-muted mb-0">Curated destinations shown across the site.</p>
        </div>

        <a href="<?php echo e(route('admin.destinations.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Destination
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="70">Image</th>
                        <th>Destination</th>
                        <th>Country</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <?php if($d->thumbnail): ?>
                                <img src="<?php echo e(asset('storage/'.$d->thumbnail)); ?>" width="48" class="rounded border">
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo e($d->name); ?></strong><br>
                            <small class="text-muted"><?php echo e($d->slug); ?></small>
                        </td>
                        <td><?php echo e($d->country); ?></td>
                        <td>
                            <?php if($d->featured): ?>
                                <span class="badge bg-warning text-dark">Featured</span>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($d->status): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('admin.destinations.edit', $d)); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?php echo e(route('admin.destinations.destroy', $d)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this destination?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center py-5">No destinations found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <?php echo e($destinations->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/destinations/index.blade.php ENDPATH**/ ?>
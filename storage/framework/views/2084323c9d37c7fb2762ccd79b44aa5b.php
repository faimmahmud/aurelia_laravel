

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="section-kicker">Countries</div>
            <h1 class="section-title mb-1">Manage countries</h1>
            <p class="text-muted mb-0">
                All countries used for destinations and tour packages.
            </p>
        </div>

        <a href="<?php echo e(route('admin.countries.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Country
        </a>
    </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>
                            <th width="70">Flag</th>
                            <th>Country</th>
                            <th>ISO</th>
                            <th>Currency</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>

                                <td>

                                    <?php if($country->flag): ?>
                                        <img src="<?php echo e(asset('storage/' . $country->flag)); ?>" width="40"
                                            class="rounded border">
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>

                                </td>

                                <td>

                                    <strong><?php echo e($country->name); ?></strong>

                                    <br>

                                    <small class="text-muted">
                                        <?php echo e($country->slug); ?>

                                    </small>

                                </td>

                                <td>

                                    <?php echo e($country->iso2); ?>


                                    /

                                    <?php echo e($country->iso3); ?>


                                </td>

                                <td>

                                    <?php echo e($country->currency); ?>


                                </td>

                                <td>

                                    <?php if($country->status): ?>
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">
                                            Inactive
                                        </span>
                                    <?php endif; ?>

                                </td>

                                <td>

                                    <a href="<?php echo e(route('admin.countries.edit', $country)); ?>" class="btn btn-sm btn-warning">

                                        Edit

                                    </a>

                                    <form action="<?php echo e(route('admin.countries.destroy', $country)); ?>" method="POST"
                                        class="d-inline">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this country?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    No countries found.

                                </td>

                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-4">

            <?php echo e($countries->links()); ?>


        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/countries/index.blade.php ENDPATH**/ ?>
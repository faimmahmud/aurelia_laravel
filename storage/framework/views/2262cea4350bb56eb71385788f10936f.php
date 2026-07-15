

<?php $__env->startSection('title', 'Branding Settings'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="fw-bold mb-1">Branding Settings</h2>
                <p class="text-muted">
                    Manage your company branding information.
                </p>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.settings.branding.update')); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Company Branding
                    </h5>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <label class="form-label">
                            Company Name
                        </label>

                        <input type="text" name="company_name" class="form-control"
                            value="<?php echo e(old('company_name', \App\Models\Setting::get('branding.company_name'))); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            Company Tagline
                        </label>

                        <input type="text" name="company_tagline" class="form-control"
                            value="<?php echo e(old('company_tagline', \App\Models\Setting::get('branding.company_tagline'))); ?>">
                    </div>

                    <hr>

                    <h5 class="mb-4">
                        Company Logo
                    </h5>

                    <div class="mb-4">

                        <label class="form-label">
                            Logo
                        </label>

                        <?php if(\App\Models\Setting::get('branding.logo')): ?>
                            <div class="mb-3">
                                <img src="<?php echo e(asset('storage/' . \App\Models\Setting::get('branding.logo'))); ?>"
                                    style="height:70px" class="img-thumbnail">
                            </div>
                        <?php endif; ?>

                        <input type="file" name="logo" class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Dark Logo
                        </label>

                        <?php if(\App\Models\Setting::get('branding.dark_logo')): ?>
                            <div class="mb-3">
                                <img src="<?php echo e(asset('storage/' . \App\Models\Setting::get('branding.dark_logo'))); ?>"
                                    style="height:70px" class="img-thumbnail">
                            </div>
                        <?php endif; ?>

                        <input type="file" name="dark_logo" class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Favicon
                        </label>

                        <?php if(\App\Models\Setting::get('branding.favicon')): ?>
                            <div class="mb-3">
                                <img src="<?php echo e(asset('storage/' . \App\Models\Setting::get('branding.favicon'))); ?>"
                                    style="height:40px" class="img-thumbnail">
                            </div>
                        <?php endif; ?>

                        <input type="file" name="favicon" class="form-control">

                    </div>

                </div>

                <div class="card-footer bg-white">

                    <button type="submit" class="btn btn-primary">
                        Save Branding
                    </button>

                </div>

            </div>

        </form>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/settings/branding.blade.php ENDPATH**/ ?>
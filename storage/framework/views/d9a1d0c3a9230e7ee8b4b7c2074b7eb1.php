

<?php $__env->startSection('content'); ?>
    <div class="container-fluid px-4 py-5">
        <!-- Header Area -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Contact Settings</h1>
                <p class="text-muted mb-0">Manage your agency's public contact information and support channels.</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>

        <!-- Alert Notifications -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> Please fix the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Main Configuration Form -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-address-book me-2"></i>Contact
                            Information</h6>
                        <span class="badge bg-light text-dark">Global Settings</span>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.settings.contact.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="row g-3">
                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label font-weight-bold">Primary Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="email" name="email"
                                            value="<?php echo e(old('email', \App\Models\Setting::get('contact.email'))); ?>"
                                            placeholder="info@aureliatravel.com">
                                    </div>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label font-weight-bold">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-phone text-muted"></i></span>
                                        <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="phone" name="phone"
                                            value="<?php echo e(old('phone', \App\Models\Setting::get('contact.phone'))); ?>"
                                            placeholder="+880 1234-567890">
                                    </div>
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- WhatsApp Number -->
                                <div class="col-md-6">
                                    <label for="whatsapp" class="form-label font-weight-bold">WhatsApp Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fab fa-whatsapp text-success"></i></span>
                                        <input type="text" class="form-control <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="whatsapp" name="whatsapp"
                                            value="<?php echo e(old('whatsapp', \App\Models\Setting::get('contact.whatsapp'))); ?>"
                                            placeholder="+880 1234-567890">
                                    </div>
                                    <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Working Hours -->
                                <div class="col-md-6">
                                    <label for="working_hours" class="form-label font-weight-bold">Working Hours</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-clock text-muted"></i></span>
                                        <input type="text"
                                            class="form-control <?php $__errorArgs = ['working_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="working_hours" name="working_hours"
                                            value="<?php echo e(old('working_hours', \App\Models\Setting::get('contact.working_hours'))); ?>"
                                            placeholder="Sat - Thu: 9:00 AM - 6:00 PM">
                                    </div>
                                    <?php $__errorArgs = ['working_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Physical Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label font-weight-bold">Office Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-map-marked-alt text-muted"></i></span>
                                        <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="address" name="address" rows="2"
                                            placeholder="123 Luxury Tower, Level 4, Gulshan, Dhaka, Bangladesh"><?php echo e(old('address', \App\Models\Setting::get('contact.address'))); ?></textarea>
                                    </div>
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <!-- Google Map Embed URL -->
                                <div class="col-12">
                                    <label for="google_map" class="form-label font-weight-bold">Google Map Embed/Share
                                        URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i
                                                class="fas fa-map-pin text-danger"></i></span>
                                        <input type="url"
                                            class="form-control <?php $__errorArgs = ['google_map'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="google_map"
                                            name="google_map"
                                            value="<?php echo e(old('google_map', \App\Models\Setting::get('contact.google_map'))); ?>"
                                            placeholder="https://maps.google.com/...">
                                    </div>
                                    <div class="form-text text-muted small">Paste the standard Google Maps share URL or
                                        embed link here.</div>
                                    <?php $__errorArgs = ['google_map'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <hr class="my-4 text-muted">

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar / Information Panel -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4 bg-gradient-primary text-white border-0">
                    <div class="card-body p-4">
                        <h5 class="font-weight-bold"><i class="fas fa-lightbulb me-2 text-warning"></i> Quick Tips</h5>
                        <p class="small mb-3 mt-2" style="opacity: 0.9;">
                            These contact options dynamically reflect on your website's footer, contact page, and booking
                            confirmation communications.
                        </p>
                        <ul class="list-unstyled small mb-0 ps-0" style="opacity: 0.85;">
                            <li class="mb-2"><i class="fas fa-check me-2 text-success-light"></i> Standardize phone
                                numbers with international codes.</li>
                            <li class="mb-2"><i class="fas fa-check me-2 text-success-light"></i> The WhatsApp number
                                handles instant visitor inquiries.</li>
                            <li><i class="fas fa-check me-2 text-success-light"></i> Make sure the email address is
                                actively monitored for client requests.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/admin/settings/contact.blade.php ENDPATH**/ ?>
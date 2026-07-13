<!doctype html>
<html lang="en">

<head>
    <?php
        $logo = \App\Models\Setting::get('branding.logo');
        $darkLogo = \App\Models\Setting::get('branding.dark_logo');
        $favicon = \App\Models\Setting::get('branding.favicon');
        $company = \App\Models\Setting::get('branding.company_name', 'Aurelia Travel');
        $tagline = \App\Models\Setting::get(
            'branding.company_tagline',
            'Luxury journeys, curated with cinematic detail.',
        );
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e($pageTitle ?? $company); ?></title>
    <meta name="description" content="<?php echo e($tagline); ?>">

    <?php if($favicon): ?>
        <link rel="icon" type="image/png" href="<?php echo e(asset('storage/' . $favicon)); ?>">
    <?php endif; ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">

    <?php echo $__env->yieldContent('styles'); ?>
    <?php echo $__env->yieldContent('head'); ?>
</head>

<body class="<?php echo $__env->yieldContent('body-class'); ?>">

    <div class="cursor"></div>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top luxury-nav">

        <div class="container-fluid px-4 px-lg-5">

            <a href="<?php echo e(route('home')); ?>" class="navbar-brand d-flex align-items-center">

                <?php if($logo): ?>
                    <img src="<?php echo e(asset('storage/' . $logo)); ?>" style="height:55px" class="me-2">
                <?php else: ?>
                    <span class="fw-bold text-uppercase letter-wide">
                        <?php echo e($company); ?>

                    </span>
                <?php endif; ?>

            </a>

            <button class="navbar-toggler border-0 shadow-none" data-bs-toggle="collapse" data-bs-target="#topNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="topNav">

                <ul class="navbar-nav mx-auto gap-lg-2">

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('destinations') ? 'active' : ''); ?>"
                            href="<?php echo e(route('destinations')); ?>">
                            Destinations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('packages') ? 'active' : ''); ?>"
                            href="<?php echo e(route('packages')); ?>">
                            Packages
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('world') ? 'active' : ''); ?>"
                            href="<?php echo e(route('world')); ?>">
                            World Explorer
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(auth()->check() ? route('booking.create') : route('login')); ?>">
                            Booking
                        </a>
                    </li>

                    <?php if(auth()->guard()->check()): ?>

                        <?php if(auth()->user()->role == 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                                    Admin
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.bookings')); ?>">
                                    Bookings
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.packages')); ?>">
                                    Packages
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

                <div class="d-flex align-items-center gap-2">

                    <?php if(auth()->guard()->check()): ?>

                        <div class="nav-user">
                            <span class="small text-white-50">Welcome</span>
                            <strong class="d-block"><?php echo e(auth()->user()->name); ?></strong>
                        </div>

                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-3">
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            Login
                        </a>

                        <a href="<?php echo e(route('register')); ?>" class="btn btn-gold btn-sm rounded-pill px-3">
                            Register
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </nav>

    
    
    

    <main>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

    <footer class="site-footer mt-5">

        <div class="container py-5">

            <div class="row gy-4">

                <div class="col-lg-5">

                    <h3 class="fw-bold text-white mb-3">
                        <?php echo e($company); ?>

                    </h3>

                    <p class="text-white-50">
                        Luxury journeys crafted with elegance,
                        cinematic storytelling and unforgettable experiences.
                    </p>

                </div>

                <div class="col-6 col-lg-2">

                    <h6 class="text-uppercase text-white-50 letter-wide">
                        Explore
                    </h6>

                    <ul class="list-unstyled footer-links">

                        <li><a href="<?php echo e(route('destinations')); ?>">Destinations</a></li>
                        <li><a href="<?php echo e(route('packages')); ?>">Packages</a></li>
                        <li><a href="<?php echo e(route('world')); ?>">World Explorer</a></li>

                    </ul>

                </div>

                <div class="col-6 col-lg-2">

                    <h6 class="text-uppercase text-white-50 letter-wide">
                        Account
                    </h6>

                    <ul class="list-unstyled footer-links">

                        <?php if(auth()->guard()->guest()): ?>

                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>

                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>

                        <?php endif; ?>

                        <li><a href="<?php echo e(route('booking.create')); ?>">Booking</a></li>

                    </ul>

                </div>

                <div class="col-lg-3">

                    <h6 class="text-uppercase text-white-50 letter-wide">
                        Newsletter
                    </h6>

                    <p class="text-white-50">
                        Premium travel updates delivered directly to you.
                    </p>

                    <form>

                        <div class="input-group">

                            <input class="form-control" placeholder="Email address">

                            <button class="btn btn-gold">
                                Join
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            <hr class="border-white border-opacity-10 my-4">

            <div class="d-flex justify-content-between flex-wrap text-white-50 small">

                <span>
                    © <?php echo e(date('Y')); ?> <?php echo e($company); ?>

                </span>

                <span>
                    Luxury Tourism Platform • Laravel
                </span>

            </div>

        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\aurelia_laravel\resources\views/layouts/master.blade.php ENDPATH**/ ?>
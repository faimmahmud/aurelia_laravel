<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ---- Bootstrap dark-glass overrides so existing admin views render on-theme ---- */
        .content{color:#eef2ff}
        .content .card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);backdrop-filter:blur(20px);color:#eef2ff;border-radius:16px}
        .content .table{color:#eef2ff}
        .content .table thead.table-light,.content .table thead{background:rgba(255,255,255,.04);color:#9aa3b2}
        .content .table td,.content .table th{border-color:rgba(255,255,255,.08)}
        .content .table-hover>tbody>tr:hover{background:rgba(255,255,255,.04);color:#fff}
        .content .form-control,.content .form-select{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.12);color:#eef2ff}
        .content .form-control:focus,.content .form-select:focus{background:rgba(255,255,255,.05);border-color:#d4af37;color:#fff;box-shadow:0 0 0 .2rem rgba(212,175,55,.15)}
        .content .form-control::placeholder{color:#7f8a9b}
        .content label,.content .form-label{color:#c9cfdb}
        .content .btn-primary,.content .btn-gold{background:linear-gradient(135deg,#d4af37,#ffe28a);border:0;color:#1b1730;font-weight:600}
        .content .btn-primary:hover,.content .btn-gold:hover{filter:saturate(1.1);color:#1b1730}
        .content .btn-outline-dark{border-color:rgba(255,255,255,.2);color:#eef2ff}
        .content .btn-outline-dark:hover{background:rgba(255,255,255,.08);color:#fff}
        .content .alert-success{background:rgba(46,204,113,.12);border-color:rgba(46,204,113,.3);color:#8be2ab}
        .content .alert-danger{background:rgba(239,68,68,.1);border-color:rgba(239,68,68,.28);color:#f2a3a3}
        .content .page-link{background:rgba(255,255,255,.03);border-color:rgba(255,255,255,.1);color:#eef2ff}
        .content .page-item.active .page-link{background:#d4af37;border-color:#d4af37;color:#1b1730}
        .content .text-muted{color:#8b93a3 !important}
        .content a{color:#d4af37}
        .section-kicker{text-transform:uppercase;letter-spacing:.14em;font-size:12px;color:#d4af37;font-weight:700;margin-bottom:6px}
        .section-title{font-size:26px;font-weight:800;color:#fff}
        .stat-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);backdrop-filter:blur(20px);border-radius:16px;padding:22px}
        .stat-card .stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;background:rgba(212,175,55,.12);color:#d4af37}
        .quick-link{display:flex;align-items:center;gap:14px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px;color:#eef2ff;text-decoration:none;transition:.2s}
        .quick-link:hover{background:rgba(255,255,255,.06);border-color:rgba(212,175,55,.4);transform:translateY(-2px);color:#fff}
        .quick-link .qi{width:44px;height:44px;border-radius:12px;background:rgba(212,175,55,.12);color:#d4af37;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
    </style>
    <style>
        :root {
            --bg: #04060a;
            --bg2: #070b14;
            --glass: rgba(255, 255, 255, .04);
            --glass2: rgba(255, 255, 255, .06);
            --text: #eef2ff;
            --muted: #9aa3b2;
            --border: rgba(255, 255, 255, .08);
            --danger: #f2a3a3;
            --danger-bg: rgba(239, 68, 68, .08);
            --danger-border: rgba(239, 68, 68, .25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        body {
            background:
                radial-gradient(circle at 20% 20%, #0c1324, transparent 40%),
                radial-gradient(circle at 80% 70%, #0a0f1c, transparent 45%),
                linear-gradient(180deg, var(--bg2), var(--bg));
            color: var(--text);
            overflow-x: hidden;
        }

        .bg {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(circle at 30% 30%, rgba(255, 255, 255, .04), transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(255, 255, 255, .03), transparent 55%);
            z-index: -3;
        }

        .blur-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            z-index: -2;
        }

        .orb1 {
            width: 600px;
            height: 600px;
            right: -200px;
            top: -200px;
            background: rgba(255, 255, 255, .04);
            animation: float 14s ease-in-out infinite;
        }

        .orb2 {
            width: 500px;
            height: 500px;
            left: -200px;
            bottom: -200px;
            background: rgba(255, 255, 255, .03);
            animation: float2 18s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-30px, 20px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -20px);
            }
        }

        .app {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 260px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, .03);
            backdrop-filter: blur(40px);
            border-right: 1px solid var(--border);
            padding: 22px;
            display: flex;
            flex-direction: column;
            transition: left .3s ease;
        }

        .brand {
            display: flex;
            gap: 10px;
            align-items: center;
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 14px;
            color: var(--text);
            padding-bottom: 18px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }

        .nav a,
        .nav button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            background: transparent;
            border: 1px solid transparent;
            color: var(--muted);
            text-decoration: none;
            cursor: pointer;
            transition: .25s;
            font-size: 14px;
        }

        .nav a:hover,
        .nav button:hover {
            background: rgba(255, 255, 255, .03);
            border: 1px solid var(--border);
            color: #fff;
            transform: translateX(4px);
        }

        .nav a.active {
            background: rgba(255, 255, 255, .05);
            border: 1px solid rgba(255, 255, 255, .12);
            color: #fff;
        }

        .nav-spacer {
            flex: 1;
        }

        .logout-btn {
            color: #ff9e9e;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 30px;
            background: rgba(255, 255, 255, .02);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(30px);
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }

        .user-chip {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        footer {
            padding: 14px;
            text-align: center;
            color: var(--muted);
            border-top: 1px solid var(--border);
            font-size: 12px;
        }

        .overlay {
            display: none;
        }

        .sidebar-toggle {
            display: none;
        }

        @media(max-width:768px) {

            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                bottom: 0;
                z-index: 100;
            }

            .sidebar.open {
                left: 0;
            }

            .overlay.open {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .5);
            }

            .sidebar-toggle {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 40px;
                height: 40px;
                border: none;
                border-radius: 10px;
                background: rgba(255, 255, 255, .05);
                color: #fff;
                cursor: pointer;
            }

        }
    </style>

</head>

<body>

    <div class="bg"></div>
    <div class="blur-orb orb1"></div>
    <div class="blur-orb orb2"></div>

    <div class="app">

        <aside class="sidebar" id="sidebar">

            <div class="brand">
                <i class="fa-solid fa-user-shield"></i>
                ADMIN PANEL
            </div>
            <nav class="nav">

                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-gauge"></i>
                    Dashboard
                </a>

                <hr style="border-color:rgba(255,255,255,.08);margin:10px 0;">

                <small style="padding:0 14px;color:#7f8a9b;font-size:12px;">
                    TRAVEL MANAGEMENT
                </small>

                <a href="<?php echo e(route('admin.destinations.index')); ?>"
                    class="<?php echo e(request()->routeIs('admin.destinations*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-earth-asia"></i>
                    Destinations
                </a>

                <a href="<?php echo e(route('admin.countries.index')); ?>"
                    class="<?php echo e(request()->routeIs('admin.countries*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-globe"></i>
                    Countries
                </a>

                <a href="<?php echo e(route('admin.packages')); ?>"
                    class="<?php echo e(request()->routeIs('admin.packages*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-suitcase"></i>
                    Packages
                </a>

                <a href="<?php echo e(route('admin.bookings')); ?>"
                    class="<?php echo e(request()->routeIs('admin.bookings*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

                <hr style="border-color:rgba(255,255,255,.08);margin:10px 0;">

                <small style="padding:0 14px;color:#7f8a9b;font-size:12px;">
                    PEOPLE
                </small>

                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="<?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">
                    <i class="fa-solid fa-users"></i>
                    Users
                </a>

                <hr style="border-color:rgba(255,255,255,.08);margin:10px 0;">

                <small style="padding:0 14px;color:#7f8a9b;font-size:12px;">
                    COMPANY
                </small>

                <a href="<?php echo e(route('admin.settings.branding')); ?>">
                    <i class="fa-solid fa-palette"></i>
                    Branding
                </a>

                <a href="<?php echo e(route('admin.settings.contact')); ?>">
                    <i class="fa-solid fa-address-book"></i>
                    Contact
                </a>

                <div class="nav-spacer"></div>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>

            </nav>

        </aside>

        <div class="overlay" id="overlay"></div>

        <main class="main">

            <nav class="topbar">

                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="user-chip">
                    <i class="fa-solid fa-circle-user"></i>
                    <strong><?php echo e(auth()->user()->name); ?></strong>
                </div>

            </nav>

            <div class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <footer>
                &copy; <?php echo e(date('Y')); ?> Aurelia Travel. All Rights Reserved.
            </footer>

        </main>

    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggle = document.getElementById('sidebarToggle');

        toggle?.addEventListener('click', () => {

            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');

        });

        overlay?.addEventListener('click', () => {

            sidebar.classList.remove('open');
            overlay.classList.remove('open');

        });
    </script>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\faim\laravel-final-project\aurelia_laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>
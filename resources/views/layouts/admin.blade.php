<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

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

                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge"></i>
                    Dashboard
                </a>

                <hr style="border-color:rgba(255,255,255,.08);margin:10px 0;">

                <small style="padding:0 14px;color:#7f8a9b;font-size:12px;">
                    TRAVEL MANAGEMENT
                </small>

                <a href="#">
                    <i class="fa-solid fa-earth-asia"></i>
                    Destinations
                </a>

                <a href="#">
                    <i class="fa-solid fa-globe"></i>
                    Countries
                </a>

                <a href="{{ route('admin.packages') }}"
                    class="{{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                    <i class="fa-solid fa-suitcase"></i>
                    Packages
                </a>

                <a href="{{ route('admin.bookings') }}"
                    class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    Bookings
                </a>

                <hr style="border-color:rgba(255,255,255,.08);margin:10px 0;">

                <small style="padding:0 14px;color:#7f8a9b;font-size:12px;">
                    COMPANY
                </small>

                <a href="{{ route('admin.settings.branding') }}">
                    <i class="fa-solid fa-palette"></i>
                    Branding
                </a>

                <a href="{{ route('admin.settings.contact') }}">
                    <i class="fa-solid fa-address-book"></i>
                    Contact
                </a>

                <div class="nav-spacer"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
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
                    <strong>{{ auth()->user()->name }}</strong>
                </div>

            </nav>

            <div class="content">
                @yield('content')
            </div>

            <footer>
                &copy; {{ date('Y') }} Aurelia Travel. All Rights Reserved.
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

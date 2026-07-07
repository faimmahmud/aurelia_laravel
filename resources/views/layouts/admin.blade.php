<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Font Awesome (fixed: was pointing at bare "cloudflare.com") -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* =========================
   CORE DESIGN SYSTEM (shared with Global Mobility System)
========================= */

:root{
    --bg:#04060a;
    --bg2:#070b14;
    --glass:rgba(255,255,255,0.04);
    --glass2:rgba(255,255,255,0.06);
    --text:#eef2ff;
    --muted:#9aa3b2;
    --border:rgba(255,255,255,0.08);
    --danger:#f2a3a3;
    --danger-bg:rgba(239,68,68,0.08);
    --danger-border:rgba(239,68,68,0.25);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI", sans-serif;
}

body{
    background:
        radial-gradient(circle at 20% 20%, #0c1324, transparent 40%),
        radial-gradient(circle at 80% 70%, #0a0f1c, transparent 45%),
        linear-gradient(180deg,var(--bg2),var(--bg));
    color:var(--text);
    overflow-x:hidden;
}

.bg{
    position:fixed;
    inset:0;
    background:
        radial-gradient(circle at 30% 30%, rgba(255,255,255,0.04), transparent 50%),
        radial-gradient(circle at 70% 60%, rgba(255,255,255,0.03), transparent 55%);
    z-index:-3;
}

.blur-orb{
    position:fixed;
    border-radius:50%;
    filter: blur(70px);
    z-index:-2;
}

.orb1{
    width:600px;
    height:600px;
    right:-200px;
    top:-200px;
    background:rgba(255,255,255,0.04);
    animation: float 14s ease-in-out infinite;
}

.orb2{
    width:500px;
    height:500px;
    left:-200px;
    bottom:-200px;
    background:rgba(255,255,255,0.03);
    animation: float2 18s ease-in-out infinite;
}

@keyframes float{
    0%,100%{transform:translate(0,0);}
    50%{transform:translate(-30px,20px);}
}

@keyframes float2{
    0%,100%{transform:translate(0,0);}
    50%{transform:translate(30px,-20px);}
}

/* =========================
   APP LAYOUT
========================= */

.app{
    display:flex;
    height:100vh;
}

/* =========================
   SIDEBAR
========================= */

.sidebar{
    width:260px;
    flex-shrink:0;
    background:rgba(255,255,255,0.03);
    backdrop-filter: blur(40px);
    border-right:1px solid var(--border);
    padding:22px;
    display:flex;
    flex-direction:column;
    transition: left .3s ease;
}

.brand{
    display:flex;
    gap:10px;
    align-items:center;
    font-weight:500;
    letter-spacing:3px;
    color:var(--text);
    opacity:0.9;
    font-size:14px;
    padding-bottom:18px;
    margin-bottom:22px;
    border-bottom:1px solid var(--border);
}

.brand i{ color:var(--muted); }

.nav{
    display:flex;
    flex-direction:column;
    gap:10px;
    flex:1;
}

.nav a,
.nav button{
    display:flex;
    gap:10px;
    align-items:center;
    padding:12px 14px;
    border-radius:12px;
    text-decoration:none;
    color:var(--muted);
    border:1px solid transparent;
    background:transparent;
    font-size:14px;
    width:100%;
    text-align:left;
    cursor:pointer;
    transition:.25s;
}

.nav a:hover,
.nav button:hover{
    background:rgba(255,255,255,0.03);
    border:1px solid var(--border);
    color:var(--text);
    transform:translateX(4px);
}

.nav a.active{
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.12);
    color:var(--text);
}

.nav-spacer{ flex:1; }

.logout-form{ margin-top:8px; }

.logout-btn{
    color:var(--danger);
}

.logout-btn:hover{
    background:var(--danger-bg);
    border:1px solid var(--danger-border);
    color:var(--danger);
}

/* =========================
   MAIN
========================= */

.main{
    flex:1;
    display:flex;
    flex-direction:column;
    min-width:0;
}

.topbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    padding:18px 30px;
    background:rgba(255,255,255,0.02);
    backdrop-filter: blur(30px);
    border-bottom:1px solid var(--border);
}

.sidebar-toggle{
    display:none;
    align-items:center;
    justify-content:center;
    width:38px;
    height:38px;
    border-radius:10px;
    background:var(--glass);
    border:1px solid var(--border);
    color:var(--text);
    cursor:pointer;
    transition:.25s;
}

.sidebar-toggle:hover{
    background:var(--glass2);
}

.user-chip{
    margin-left:auto;
    display:flex;
    align-items:center;
    gap:10px;
    color:var(--muted);
    font-size:14px;
}

.user-chip i{
    font-size:22px;
    color:var(--muted);
}

.user-chip strong{
    color:var(--text);
    font-weight:500;
}

.content{
    flex:1;
    padding:30px;
    overflow-y:auto;
}

footer{
    text-align:center;
    padding:14px;
    font-size:12px;
    color:var(--muted);
    border-top:1px solid var(--border);
}

/* =========================
   RESPONSIVE
========================= */

.overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.5);
    z-index:40;
}

@media (max-width: 768px){
    .sidebar{
        position:fixed;
        left:-280px;
        top:0;
        bottom:0;
        z-index:50;
    }
    .sidebar.open{
        left:0;
    }
    .sidebar-toggle{
        display:flex;
    }
    .overlay.open{
        display:block;
    }
}

</style>
</head>

<body>

<div class="bg"></div>
<div class="blur-orb orb1"></div>
<div class="blur-orb orb2"></div>

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <i class="fa-solid fa-user-shield"></i>
            ADMIN PANEL
        </div>

        <nav class="nav">
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>

            <div class="nav-spacer"></div>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </nav>

    </aside>

    <div class="overlay" id="overlay"></div>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <nav class="topbar">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="user-chip">
                <i class="fa-solid fa-circle-user"></i>
                Welcome, <strong>{{ auth()->user()->name }}</strong>
            </div>
        </nav>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>

        <footer>
            &copy; {{ date('Y') }} Visaway Consultancy. All rights reserved.
        </footer>

    </main>

</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggle = document.getElementById('sidebarToggle');

    function closeSidebar(){
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
    }

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('open');
    });

    overlay.addEventListener('click', closeSidebar);
</script>

</body>

</html>
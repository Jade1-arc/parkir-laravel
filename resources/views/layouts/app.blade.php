<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #0f2027;
            font-family: 'Orbitron', Arial, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        /* 1. Animated Gradient */
        .bg-animated-gradient {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -3;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(120deg, #0f2027, #2c5364, #7f66ff, #00ffe7, #ffd600);
            background-size: 400% 400%;
            animation: gradientMove 18s ease-in-out infinite;
        }
        @keyframes gradientMove {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        /* 2. Moving Parking Lines */
        .bg-parking-lines {
            position: fixed;
            left: 0; right: 0; bottom: 0;
            height: 180px;
            z-index: -2;
            pointer-events: none;
        }
        .parking-line {
            stroke: #ffe066;
            stroke-width: 8;
            stroke-linecap: round;
            opacity: 0.7;
            animation: lineMove 6s linear infinite;
        }
        @keyframes lineMove {
            0% {transform: translateX(0);}
            100% {transform: translateX(80px);}
        }
        /* 3. Floating Neon Particles */
        .bg-particles {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -1;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.18;
            filter: blur(1.5px);
            animation: floatParticle 12s linear infinite;
        }
        .particle1 { width: 60px; height: 60px; background: #00ffe7; left: 10vw; top: 60vh; animation-delay: 0s; }
        .particle2 { width: 40px; height: 40px; background: #ffd600; left: 80vw; top: 30vh; animation-delay: 2s; }
        .particle3 { width: 30px; height: 30px; background: #7f66ff; left: 50vw; top: 80vh; animation-delay: 4s; }
        .particle4 { width: 50px; height: 50px; background: #fff; left: 70vw; top: 10vh; animation-delay: 6s; }
        .particle5 { width: 35px; height: 35px; background: #00ffe7; left: 30vw; top: 20vh; animation-delay: 8s; }
        @keyframes floatParticle {
            0% { transform: translateY(0) scale(1); opacity: 0.18; }
            50% { transform: translateY(-60px) scale(1.2); opacity: 0.28; }
            100% { transform: translateY(0) scale(1); opacity: 0.18; }
        }
        .parking-bg {
            position: fixed;
            right: 0;
            bottom: 0;
            width: 520px;
            height: 320px;
            z-index: 0;
            opacity: 0.22;
            pointer-events: none;
        }
        .sidebar {
            min-height: 100vh;
            background: rgba(30, 30, 60, 0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(8px);
            border-right: 2px solid rgba(255,255,255,0.1);
            color: #fff;
            padding-top: 2rem;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            transition: background 0.3s, box-shadow 0.3s, transform 0.3s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #7f66ff 0%, #00ffe7 100%);
            color: #fff;
            box-shadow: 0 0 12px #00ffe7, 0 0 24px #7f66ff;
            transform: scale(1.05);
        }
        .sidebar .sidebar-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: 2px;
            color: #00ffe7;
            text-shadow: 0 0 8px #7f66ff;
        }
        .main-content {
            padding: 2rem 2rem 2rem 2rem;
            min-height: 100vh;
            transition: opacity 0.5s;
        }
        .glow {
            box-shadow: 0 0 16px 2px #00ffe7, 0 0 32px 4px #7f66ff;
        }
        #page-loader {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15,32,39,0.95);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s;
        }
        .loader {
            border: 8px solid #222;
            border-top: 8px solid #00ffe7;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 32px #00ffe7;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @media (max-width: 991px) {
            .sidebar { min-height: auto; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="bg-animated-gradient"></div>
    <svg class="bg-parking-lines" width="100vw" height="180" viewBox="0 0 1200 180" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line class="parking-line" x1="100" y1="40" x2="1100" y2="40" />
        <line class="parking-line" x1="100" y1="80" x2="1100" y2="80" />
        <line class="parking-line" x1="100" y1="120" x2="1100" y2="120" />
        <line class="parking-line" x1="100" y1="160" x2="1100" y2="160" />
    </svg>
    <div class="bg-particles">
        <div class="particle particle1"></div>
        <div class="particle particle2"></div>
        <div class="particle particle3"></div>
        <div class="particle particle4"></div>
        <div class="particle particle5"></div>
    </div>
    <div id="page-loader"><div class="loader"></div></div>
    <!-- Background parkiran SVG -->
    <div class="parking-bg">
        <svg viewBox="0 0 520 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="30" y="220" width="460" height="60" rx="18" fill="#fff" fill-opacity="0.12"/>
            <rect x="60" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="180" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="300" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="420" y="240" width="40" height="12" rx="6" fill="#ffe066"/>
            <!-- Mobil -->
            <rect x="100" y="180" width="60" height="30" rx="8" fill="#00ffe7" fill-opacity="0.7"/>
            <rect x="360" y="180" width="60" height="30" rx="8" fill="#7f66ff" fill-opacity="0.7"/>
            <rect x="230" y="180" width="60" height="30" rx="8" fill="#ffd600" fill-opacity="0.7"/>
            <!-- Lampu -->
            <ellipse cx="130" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
            <ellipse cx="390" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
            <ellipse cx="260" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
        </svg>
    </div>
    @php
        $hideNav = request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('petugas.login') || request()->routeIs('welcome');
    @endphp
    @if(!$hideNav)
    <div class="container-fluid">
        <div class="row">
            <nav class="col-lg-2 d-none d-lg-block sidebar position-fixed">
                <div class="sidebar-title">Aplikasi Parkir</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        @if(Auth::user() && Auth::user()->role === 'admin')
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        @elseif(Auth::user() && Auth::user()->role === 'petugas')
                            <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">Dashboard</a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('parkir*') ? 'active' : '' }}" href="{{ route('parkir.index') }}">Data Parkir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('scan*') ? 'active' : '' }}" href="{{ url('scan') }}">Scan Barcode</a>
                    </li>
                    @if(Auth::user() && Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">User</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">Laporan</a>
                    </li>
                    <li class="nav-item mt-4">
                        @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Logout</button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-light w-100 mb-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Register</a>
                        @endauth
                    </li>
                </ul>
            </nav>
            <main class="col-lg-10 offset-lg-2 main-content">
                @yield('content')
            </main>
        </div>
    </div>
    @else
        @yield('content')
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation: Hide loader after page load
        window.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.getElementById('page-loader').style.opacity = 0;
                setTimeout(function() {
                    document.getElementById('page-loader').style.display = 'none';
                }, 500);
            }, 800);
        });
    </script>
</body>
</html>

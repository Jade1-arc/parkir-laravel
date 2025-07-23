<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang | Aplikasi Parkir</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: none;
            overflow-x: hidden;
        }
        .bg-animated-gradient {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background: linear-gradient(120deg, #00ffe7 0%, #7f66ff 100%);
            z-index: 0; animation: gradientMove 8s ease-in-out infinite alternate;
        }
        @keyframes gradientMove {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(40deg); }
        }
        .bg-parking-lines { position: fixed; left: 0; bottom: 0; width: 100vw; z-index: 1; opacity: 0.5; }
        .parking-line { stroke: #ffe066; stroke-width: 6; stroke-linecap: round; }
        .bg-particles { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 2; pointer-events: none; }
        .particle { position: absolute; border-radius: 50%; opacity: 0.18; }
        .particle1 { width: 80px; height: 80px; background: #00ffe7; left: 10vw; top: 12vh; animation: float1 8s infinite alternate; }
        .particle2 { width: 50px; height: 50px; background: #7f66ff; left: 70vw; top: 18vh; animation: float2 7s infinite alternate; }
        .particle3 { width: 40px; height: 40px; background: #ffe066; left: 40vw; top: 60vh; animation: float3 9s infinite alternate; }
        .particle4 { width: 30px; height: 30px; background: #fff; left: 80vw; top: 80vh; animation: float4 6s infinite alternate; }
        .particle5 { width: 60px; height: 60px; background: #ff6f61; left: 20vw; top: 80vh; animation: float5 10s infinite alternate; }
        @keyframes float1 { 0%{transform:translateY(0);} 100%{transform:translateY(-30px);} }
        @keyframes float2 { 0%{transform:translateY(0);} 100%{transform:translateY(40px);} }
        @keyframes float3 { 0%{transform:translateY(0);} 100%{transform:translateY(-20px);} }
        @keyframes float4 { 0%{transform:translateY(0);} 100%{transform:translateY(25px);} }
        @keyframes float5 { 0%{transform:translateY(0);} 100%{transform:translateY(-35px);} }
        .parking-bg { position: fixed; left: 50%; bottom: 0; transform: translateX(-50%); z-index: 1; opacity: 0.18; }
        #page-loader { position: fixed; z-index: 9999; top: 0; left: 0; width: 100vw; height: 100vh; background: #0e1a2b; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s; }
        .loader { border: 6px solid #fff; border-top: 6px solid #00ffe7; border-radius: 50%; width: 60px; height: 60px; animation: spin 1s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        /* Split login custom style (dari sebelumnya) */
        .split-login-bg { display: flex; min-height: 80vh; background: none; justify-content: center; align-items: center; z-index: 10; position: relative; }
        .split-login-left { background: rgba(20,30,40,0.98); border-radius: 1.5rem; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); width: 100%; max-width: 420px; padding: 3rem 2.5rem 2.5rem 2.5rem; display: flex; flex-direction: column; align-items: center; z-index: 11; }
        .split-login-logo { width: 70px; margin-bottom: 1.2rem; }
        .split-login-clock { font-size: 2.5rem; color: #00ffe7; font-family: 'Orbitron', Arial, sans-serif; text-shadow: 0 0 8px #7f66ff; margin-bottom: 0.2rem; letter-spacing: 2px; }
        .split-login-date { color: #fff; font-size: 1.1rem; margin-bottom: 1.5rem; }
        .split-login-title { background: #009688; color: #fff; font-weight: 700; width: 100%; text-align: left; padding: 0.7rem 1rem; border-radius: 0.5rem 0.5rem 0 0; margin-bottom: 1.5rem; font-size: 1.1rem; letter-spacing: 1px; }
        .split-login-btn { font-size: 1.2rem; font-weight: 700; border-radius: 0.5rem; padding: 0.7rem 0; margin-bottom: 1rem; box-shadow: 0 0 12px #00ffe7; transition: transform 0.2s, box-shadow 0.2s; }
        .split-login-btn:hover { transform: scale(1.04); box-shadow: 0 0 24px #00ffe7, 0 0 32px #7f66ff; }
        .split-login-btn-admin { background: #7f66ff; color: #fff; box-shadow: 0 0 12px #7f66ff; }
        .split-login-btn-petugas { background: #00ffe7; color: #222; box-shadow: 0 0 12px #00ffe7; }
        @media (max-width: 900px) { .split-login-bg { flex-direction: column; } .split-login-left { border-radius: 1.5rem; max-width: 100%; } }
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
    <div class="parking-bg">
        <svg viewBox="0 0 520 320" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="30" y="220" width="460" height="60" rx="18" fill="#fff" fill-opacity="0.12"/>
            <rect x="60" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="180" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="300" y="240" width="80" height="12" rx="6" fill="#ffe066"/>
            <rect x="420" y="240" width="40" height="12" rx="6" fill="#ffe066"/>
            <rect x="100" y="180" width="60" height="30" rx="8" fill="#00ffe7" fill-opacity="0.7"/>
            <rect x="360" y="180" width="60" height="30" rx="8" fill="#7f66ff" fill-opacity="0.7"/>
            <rect x="230" y="180" width="60" height="30" rx="8" fill="#ffd600" fill-opacity="0.7"/>
            <ellipse cx="130" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
            <ellipse cx="390" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
            <ellipse cx="260" cy="210" rx="8" ry="4" fill="#fff" fill-opacity="0.3"/>
        </svg>
    </div>
    <div class="split-login-bg">
        <div class="split-login-left">
            <svg class="split-login-logo" viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="28" fill="#fff"/><circle cx="32" cy="32" r="24" fill="#ff6f61"/><text x="32" y="42" text-anchor="middle" font-size="32" font-family="Orbitron,Arial,sans-serif" fill="#fff" font-weight="bold">P</text></svg>
            <div class="split-login-clock" id="clock">00:00</div>
            <div class="split-login-date" id="date">-</div>
            <div class="split-login-title">Login Petugas Parkir / Admin</div>
            <a href="{{ route('petugas.login') }}" class="btn split-login-btn split-login-btn-petugas w-100">Login Petugas</a>
            <a href="{{ route('login') }}" class="btn split-login-btn split-login-btn-admin w-100">Login Admin</a>
        </div>
    </div>
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
        // Jam digital dan tanggal
        function updateClock() {
            const now = new Date();
            let h = now.getHours().toString().padStart(2, '0');
            let m = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('clock').textContent = h + ':' + m;
            const days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
            const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            let dateStr = days[now.getDay()] + ', ' + now.getDate().toString().padStart(2, '0') + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
            document.getElementById('date').textContent = dateStr;
        }
        setInterval(updateClock, 1000); updateClock();
    </script>
</body>
</html> 
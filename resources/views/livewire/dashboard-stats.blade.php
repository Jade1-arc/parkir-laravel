<style>
    .stat-card {
        background: rgba(255,255,255,0.12);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(8px);
        border: 1.5px solid rgba(255,255,255,0.18);
        color: #fff;
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s, opacity 0.7s;
        opacity: 0;
        transform: translateY(40px);
        animation: fadeInUp 1s forwards;
    }
    .stat-card:hover {
        box-shadow: 0 0 32px #00ffe7, 0 0 64px #7f66ff;
        background: rgba(0,255,231,0.18);
        transform: scale(1.05) translateY(-4px);
    }
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .stat-title {
        font-size: 1.2rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    .stat-value {
        font-size: 2.8rem;
        font-weight: 700;
        text-shadow: 0 0 12px #00ffe7, 0 0 24px #7f66ff;
    }
</style>
<div class="container my-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="w-100">
        <h2 class="text-center mb-4 fw-bold" style="color:#00ffe7;text-shadow:0 0 8px #7f66ff;">Statistik Parkir</h2>
        <div class="row justify-content-center g-4">
            <div class="col-12 col-md-3">
                <div class="stat-card text-center p-4" style="border-left: 6px solid #2196f3;">
                    <div class="stat-title">Total Parkir</div>
                    <div class="stat-value" id="stat-total">0</div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card text-center p-4" style="border-left: 6px solid #00c853;">
                    <div class="stat-title">Masuk Hari Ini</div>
                    <div class="stat-value" id="stat-masuk">0</div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card text-center p-4" style="border-left: 6px solid #ffd600;">
                    <div class="stat-title">Keluar Hari Ini</div>
                    <div class="stat-value" id="stat-keluar">0</div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="stat-card text-center p-4" style="border-left: 6px solid #ff1744;">
                    <div class="stat-title">Masih Parkir</div>
                    <div class="stat-value" id="stat-masih">0</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Animasi count up untuk statistik (hanya naik, tidak pernah negatif)
    function animateValue(id, start, end, duration) {
        if (end <= 0) {
            document.getElementById(id).textContent = 0;
            return;
        }
        let range = end - start;
        let current = start;
        let increment = 1;
        let stepTime = Math.abs(Math.floor(duration / range));
        if (stepTime < 20) stepTime = 20;
        let obj = document.getElementById(id);
        let timer = setInterval(function() {
            current += increment;
            obj.textContent = current;
            if (current >= end) {
                clearInterval(timer);
            }
        }, stepTime);
    }
    document.addEventListener('DOMContentLoaded', function() {
        animateValue('stat-total', 0, {{ max(0, $totalParkir) }}, 1200);
        animateValue('stat-masuk', 0, {{ max(0, $masukHariIni) }}, 1200);
        animateValue('stat-keluar', 0, {{ max(0, $keluarHariIni) }}, 1200);
        animateValue('stat-masih', 0, {{ max(0, $masihParkir) }}, 1200);
    });
</script>

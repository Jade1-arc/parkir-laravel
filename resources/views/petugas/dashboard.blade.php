@extends('layouts.app')
@section('content')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(120deg, #0f2027 0%, #2c5364 100%);
            min-height: 100vh;
        }
        .dashboard-title {
            font-family: 'Orbitron', sans-serif;
            color: #1e293b;
            text-shadow: 0 2px 12px #ffd70044;
            font-size: 2.2rem;
            letter-spacing: 1.5px;
        }
        .stat-card {
            border-radius: 1.5rem;
            background: rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            border: 1.5px solid #e2e8f0;
            padding: 1.2rem 0.5rem;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s;
        }
        .stat-card:hover {
            box-shadow: 0 0 24px #ffd70055, 0 0 32px #00c89633;
        }
        .stat-title {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 600;
        }
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #ffd70033;
        }
        .btn-elegant {
            background: linear-gradient(90deg, #00c896 0%, #ffd700 100%);
            color: #222;
            font-weight: 600;
            border: none;
            border-radius: 0.7rem;
            box-shadow: 0 0 12px #ffd70044;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-elegant:hover {
            background: linear-gradient(90deg, #ffd700 0%, #00c896 100%);
            color: #1e293b;
            box-shadow: 0 0 24px #ffd70077;
        }
        .glass-card {
            background: rgba(255,255,255,0.85);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            border: 1.5px solid #e2e8f0;
            padding: 2rem 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: #1e293b;
        }
        .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 2px #ffd70044;
        }
        .barcode-glass {
            background: rgba(255,255,255,0.95);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            border: 2px solid #ffd700;
            padding: 1.5rem 1rem;
        }
        .btn-print {
            background: #ffd700;
            color: #1e293b;
            font-weight: 700;
            border-radius: 0.7rem;
            border: none;
            box-shadow: 0 0 12px #ffd70044;
        }
        .btn-print:hover {
            background: #00c896;
            color: #fff;
        }
        .swal2-popup {
            font-family: 'Poppins', Arial, sans-serif !important;
            border-radius: 1.2rem !important;
        }
        @media (max-width: 767px) {
            .glass-card, .barcode-glass { padding: 1rem 0.5rem; }
            .dashboard-title { font-size: 1.3rem; }
        }
    </style>
</head>
<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="dashboard-title mb-2">Dashboard Petugas Parkir</h2>
        <p class="lead" style="color:#64748b;font-weight:600;">Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <b>Petugas Parkir</b>.</p>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card text-center">
                <div class="stat-title">Total Parkir</div>
                <div class="stat-value" id="stat-total">{{ $totalParkir ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card text-center">
                <div class="stat-title">Masuk Hari Ini</div>
                <div class="stat-value" id="stat-masuk">{{ $masukHariIni ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card text-center">
                <div class="stat-title">Keluar Hari Ini</div>
                <div class="stat-value" id="stat-keluar">{{ $keluarHariIni ?? 0 }}</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card text-center">
                <div class="stat-title">Masih Parkir</div>
                <div class="stat-value" id="stat-masih">{{ $masihParkir ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="{{ route('parkir.index') }}" class="btn btn-elegant btn-lg w-100 mb-3">Kelola Data Parkir</a>
        </div>
    </div>
</div>
<script>
// Animasi count-up statistik
function animateCount(id, target) {
    let el = document.getElementById(id);
    if (!el) return;
    let start = 0;
    let end = parseInt(target);
    let duration = 900;
    let step = Math.ceil(end / (duration/30));
    let current = start;
    let interval = setInterval(function() {
        current += step;
        if (current >= end) {
            el.innerText = end;
            clearInterval(interval);
        } else {
            el.innerText = current;
        }
    }, 30);
}
document.addEventListener('DOMContentLoaded', function() {
    animateCount('stat-total', {{ $totalParkir ?? 0 }});
    animateCount('stat-masuk', {{ $masukHariIni ?? 0 }});
    animateCount('stat-keluar', {{ $keluarHariIni ?? 0 }});
    animateCount('stat-masih', {{ $masihParkir ?? 0 }});
});
</script>
@endsection 
<!-- Barcode Scanner JS & SweetAlert2 -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let qrScanner;
    const platInput = document.getElementById('plat_nomor_input');
    const barcodeResult = document.getElementById('barcode-result');
    const formTitle = document.getElementById('form-title');
    const btnAksi = document.getElementById('btn-aksi');
    const jenisKendaraanGroup = document.getElementById('jenis-kendaraan-group');
    const biayaParkirGroup = document.getElementById('biaya-parkir-group');
    const biayaParkirInput = document.getElementById('biaya_parkir_input');
    const formParkir = document.getElementById('form-parkir');

    // Data parkir hari ini dari backend (untuk JS)
    const parkirHariIni = @json($parkirHariIni ?? []);

    function resetFormMasuk() {
        formTitle.innerText = 'Input Parkir Masuk';
        btnAksi.innerText = 'Parkir Masuk';
        jenisKendaraanGroup.classList.remove('d-none');
        biayaParkirGroup.classList.add('d-none');
        formParkir.action = "{{ route('parkir.store') }}";
    }
    function setFormKeluar(data) {
        formTitle.innerText = 'Konfirmasi Parkir Keluar';
        btnAksi.innerText = 'Parkir Keluar';
        jenisKendaraanGroup.classList.add('d-none');
        biayaParkirGroup.classList.remove('d-none');
        biayaParkirInput.value = 'Rp' + (data.biaya_parkir ? data.biaya_parkir.toLocaleString('id-ID') : '0');
        formParkir.action = `/parkir/${data.id}/keluar`;
    }

    // Notifikasi sukses/gagal dari backend (flash session)
    @if(session('success'))
    Swal.fire({ icon: 'success', title: 'Sukses', text: '{{ session('success') }}', timer: 1800, showConfirmButton: false });
    @endif  
    @if(session('error'))
    Swal.fire({ icon: 'error', title: 'Gagal', text: '{{ session('error') }}', timer: 2000, showConfirmButton: false });
    @endif
});
</script> 
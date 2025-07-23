@extends('layouts.app')
@section('content')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; background: linear-gradient(120deg, #0f2027 0%, #2c5364 100%); min-height: 100vh; }
        .scan-title { font-family: 'Orbitron', sans-serif; color: #1e293b; text-shadow: 0 2px 12px #ffd70044; font-size: 2rem; letter-spacing: 1.5px; }
        .scan-card { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18); border: 2px solid #ffd700; padding: 2rem 1.5rem; max-width: 480px; margin:auto; }
        .btn-elegant { background: linear-gradient(90deg, #00c896 0%, #ffd700 100%); color: #222; font-weight: 600; border: none; border-radius: 0.7rem; box-shadow: 0 0 12px #ffd70044; transition: background 0.2s, box-shadow 0.2s; }
        .btn-elegant:hover { background: linear-gradient(90deg, #ffd700 0%, #00c896 100%); color: #1e293b; box-shadow: 0 0 24px #ffd70077; }
        #qr-reader { width:100%; min-height:220px; border-radius:1rem; background:#f8fafc; }
        .scan-result { font-size:1.1rem; color:#1e293b; font-weight:600; margin-top:1rem; }
        .nav-scan {
            display: flex; justify-content: center; margin-bottom: 2rem;
        }
        .nav-scan .nav-btn {
            font-family: 'Orbitron',sans-serif;
            font-size: 1.1rem;
            background: none;
            border: none;
            color: #64748b;
            padding: 0.7rem 2.2rem;
            margin: 0 0.2rem;
            border-radius: 1.2rem 1.2rem 0 0;
            font-weight: 700;
            transition: background 0.2s, color 0.2s;
        }
        .nav-scan .nav-btn.active {
            background: linear-gradient(90deg, #ffd700 0%, #00c896 100%);
            color: #1e293b;
            box-shadow: 0 0 12px #ffd70044;
        }
        @media (max-width: 767px) { .scan-card { padding: 1rem 0.5rem; } .scan-title { font-size: 1.2rem; } .nav-scan .nav-btn { font-size: 0.95rem; padding: 0.6rem 1.1rem; } }
    </style>
</head>
<div class="container py-5">
    <div class="nav-scan">
        <button class="nav-btn active" id="tab-scan">Scan Barcode</button>
        <button class="nav-btn" id="tab-input">Input Parkir Masuk</button>
    </div>
    <div id="content-scan">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="scan-card text-center">
                    <h2 class="scan-title mb-3">Scan Barcode Parkir</h2>
                    <button class="btn btn-elegant mb-3" id="btn-start-scan"><i class="bi bi-upc-scan"></i> Mulai Scan</button>
                    <div id="qr-reader" class="mb-2" style="display:none;"></div>
                    <div class="scan-result" id="scan-result"></div>
                    <div class="small text-muted mt-2">Arahkan barcode tiket parkir ke kamera untuk proses keluar/masuk kendaraan.</div>
                </div>
            </div>
        </div>
    </div>
    <div id="content-input" style="display:none;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="scan-card">
                    <h2 class="scan-title mb-3">Input Parkir Masuk</h2>
                    <form action="{{ route('parkir.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Plat Nomor / ID Parkir</label>
                            <input type="text" name="plat_nomor" class="form-control" required placeholder="Contoh: B 1234 XYZ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kendaraan</label>
                            <select name="jenis_kendaraan" class="form-control" required>
                                <option value="Mobil">Mobil</option>
                                <option value="Motor">Motor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-elegant w-100 mt-2">Parkir Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabScan = document.getElementById('tab-scan');
    const tabInput = document.getElementById('tab-input');
    const contentScan = document.getElementById('content-scan');
    const contentInput = document.getElementById('content-input');
    tabScan.addEventListener('click', function() {
        tabScan.classList.add('active');
        tabInput.classList.remove('active');
        contentScan.style.display = '';
        contentInput.style.display = 'none';
    });
    tabInput.addEventListener('click', function() {
        tabInput.classList.add('active');
        tabScan.classList.remove('active');
        contentInput.style.display = '';
        contentScan.style.display = 'none';
    });
    // Scan barcode logic
    let qrScanner;
    const btnStart = document.getElementById('btn-start-scan');
    const qrReader = document.getElementById('qr-reader');
    const scanResult = document.getElementById('scan-result');
    btnStart.addEventListener('click', function() {
        qrReader.style.display = '';
        btnStart.style.display = 'none';
        if (!qrScanner) {
            qrScanner = new Html5Qrcode("qr-reader");
        }
        Html5Qrcode.getCameras().then(cameras => {
            let cameraId = null;
            if (cameras && cameras.length) {
                cameraId = cameras.find(cam => cam.label.toLowerCase().includes('back'))?.id || cameras[0].id;
            }
            qrScanner.start(
                cameraId ? { deviceId: { exact: cameraId } } : { facingMode: "environment" },
                { fps: 10, qrbox: 250 },
                (decodedText, decodedResult) => {
                    scanResult.innerText = 'Barcode: ' + decodedText;
                    Swal.fire({ icon: 'success', title: 'Barcode Terdeteksi', text: decodedText, timer: 1500, showConfirmButton: false });
                    qrScanner.stop();
                    btnStart.style.display = '';
                    qrReader.style.display = 'none';
                    // TODO: Kirim decodedText ke backend untuk proses keluar/masuk
                },
                (errorMessage) => {}
            );
        });
    });
});
</script>
@endsection 
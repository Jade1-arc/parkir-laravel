@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Data Parkir</h1>
    <div class="mb-3">
        <strong>Plat Nomor:</strong> {{ $parkir->plat_nomor }}
    </div>
    <div class="mb-3">
        <strong>Jenis Kendaraan:</strong> {{ $parkir->jenis_kendaraan }}
    </div>
    <div class="mb-3">
        <strong>Waktu Masuk:</strong> {{ $parkir->waktu_masuk }}
    </div>
    <div class="mb-3">
        <strong>Waktu Keluar:</strong> {{ $parkir->waktu_keluar }}
    </div>
    <a href="{{ route('parkir.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection 
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Parkir</h1>
    <form action="{{ route('parkir.update', $parkir) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control" value="{{ $parkir->plat_nomor }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kendaraan</label>
            <input type="text" name="jenis_kendaraan" class="form-control" value="{{ $parkir->jenis_kendaraan }}" required>
        </div>
        <div class="mb-3">
            <label>Waktu Masuk</label>
            <input type="datetime-local" name="waktu_masuk" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($parkir->waktu_masuk)) }}" required>
        </div>
        <div class="mb-3">
            <label>Waktu Keluar</label>
            <input type="datetime-local" name="waktu_keluar" class="form-control" value="{{ $parkir->waktu_keluar ? date('Y-m-d\TH:i', strtotime($parkir->waktu_keluar)) : '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('parkir.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 
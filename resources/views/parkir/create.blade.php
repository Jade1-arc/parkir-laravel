@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Parkir</h1>
    <form action="{{ route('parkir.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Plat Nomor</label>
            <input type="text" name="plat_nomor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kendaraan</label>
            <input type="text" name="jenis_kendaraan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Waktu Masuk</label>
            <input type="datetime-local" name="waktu_masuk" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('parkir.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 
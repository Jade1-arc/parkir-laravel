@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Parkir</h1>
    <form class="row g-3 mb-3" method="GET" action="{{ route('laporan.index') }}">
        <div class="col-auto">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="col-auto">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('laporan.export', request()->all()) }}" class="btn btn-success">Export CSV</a>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plat Nomor</th>
                <th>Jenis Kendaraan</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parkirs as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->plat_nomor }}</td>
                <td>{{ $p->jenis_kendaraan }}</td>
                <td>{{ $p->waktu_masuk }}</td>
                <td>{{ $p->waktu_keluar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
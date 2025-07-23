@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Parkir</h1>
    <a href="{{ route('parkir.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Plat Nomor</th>
                <th>Jenis Kendaraan</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Barcode</th>
                <th>Biaya Parkir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parkirs as $parkir)
            <tr>
                <td>{{ $parkir->id }}</td>
                <td>{{ $parkir->plat_nomor }}</td>
                <td>{{ $parkir->jenis_kendaraan }}</td>
                <td>{{ $parkir->waktu_masuk }}</td>
                <td>{{ $parkir->waktu_keluar ?? '-' }}</td>
                <td>
                    @if($parkir->kode_barcode)
                        <svg id="barcode-{{ $parkir->id }}"></svg>
                        <script>document.addEventListener('DOMContentLoaded',function(){JsBarcode("#barcode-{{ $parkir->id }}","{{ $parkir->kode_barcode }}",{format:"CODE128",width:2,height:40,displayValue:false});});</script>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($parkir->biaya_parkir)
                        Rp{{ number_format($parkir->biaya_parkir,0,',','.') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <!-- Tombol Lihat -->
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $parkir->id }}">Lihat</button>
                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail{{ $parkir->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $parkir->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalDetailLabel{{ $parkir->id }}">Detail Tiket Parkir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body text-center">
                            <svg id="barcode-modal-{{ $parkir->id }}"></svg>
                            <script>document.addEventListener('DOMContentLoaded',function(){JsBarcode("#barcode-modal-{{ $parkir->id }}","{{ $parkir->kode_barcode }}",{format:"CODE128",width:2,height:60,displayValue:true});});</script>
                            <div class="mt-2"><b>Plat Nomor:</b> {{ $parkir->plat_nomor }}</div>
                            <div><b>Jenis:</b> {{ $parkir->jenis_kendaraan }}</div>
                            <div><b>Masuk:</b> {{ $parkir->waktu_masuk }}</div>
                            <div><b>Keluar:</b> {{ $parkir->waktu_keluar ?? '-' }}</div>
                            <div class="mt-2" style="font-size:1.2rem;"><b>Biaya Parkir:</b> Rp{{ number_format($parkir->biaya_parkir,0,',','.') }}</div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" onclick="printBarcode{{ $parkir->id }}()"><i class="bi bi-printer"></i> Print</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                    function printBarcode{{ $parkir->id }}() {
                        const printContents = document.querySelector('#modalDetail{{ $parkir->id }} .modal-body').innerHTML;
                        const win = window.open('', '', 'height=400,width=600');
                        win.document.write('<html><head><title>Print Barcode</title>');
                        win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
                        win.document.write('<style>body{text-align:center;padding:2rem;background:#222;}svg{margin:auto;display:block;}div{font-family:Orbitron,sans-serif;}</style>');
                        win.document.write('</head><body>');
                        win.document.write(printContents);
                        win.document.write('</body></html>');
                        win.document.close();
                        win.focus();
                        setTimeout(function(){ win.print(); win.close(); }, 500);
                    }
                    </script>
                    <!-- Tombol Edit, Hapus, Masuk Lagi, dst tetap -->
                    <a href="{{ route('parkir.show', $parkir) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('parkir.edit', $parkir) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if(is_null($parkir->waktu_keluar))
                        <form action="{{ route('parkir.keluar', $parkir) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Keluar</button>
                        </form>
                    @else
                        <form action="{{ route('parkir.masuk', $parkir) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm">Masuk Lagi</button>
                        </form>
                    @endif
                    <form action="{{ route('parkir.destroy', $parkir) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
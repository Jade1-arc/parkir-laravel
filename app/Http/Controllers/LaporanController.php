<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Parkir::query();
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('waktu_masuk', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('waktu_masuk', '<=', $request->tanggal_selesai);
        }
        $parkirs = $query->orderBy('waktu_masuk', 'desc')->get();
        return view('laporan.index', compact('parkirs'));
    }

    public function export(Request $request)
    {
        // Export ke CSV sederhana (bisa dikembangkan ke PDF/Excel)
        $query = Parkir::query();
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('waktu_masuk', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('waktu_masuk', '<=', $request->tanggal_selesai);
        }
        $parkirs = $query->orderBy('waktu_masuk', 'desc')->get();
        $csv = "ID,Plat Nomor,Jenis Kendaraan,Waktu Masuk,Waktu Keluar\n";
        foreach ($parkirs as $p) {
            $csv .= "{$p->id},{$p->plat_nomor},{$p->jenis_kendaraan},{$p->waktu_masuk},{$p->waktu_keluar}\n";
        }
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="laporan_parkir.csv"',
        ]);
    }
} 
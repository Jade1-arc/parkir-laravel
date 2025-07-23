<?php

namespace App\Http\Controllers;

use App\Models\Parkir;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParkirController extends Controller
{
    public function index()
    {
        $parkirs = Parkir::all();
        return view('parkir.index', compact('parkirs'));
    }

    public function create()
    {
        return view('parkir.create');
    }

    public function store(Request $request)
    {
        $kodeBarcode = 'PKR-' . strtoupper(Str::random(8));
        $parkir = Parkir::create([
            'plat_nomor' => $request->plat_nomor,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'waktu_masuk' => now(),
            'kode_barcode' => $kodeBarcode,
        ]);
        // Simpan barcode ke session untuk preview
        return redirect()->back()->with(['barcode' => $kodeBarcode, 'biaya_parkir' => 0]);
    }

    public function show(Parkir $parkir)
    {
        return view('parkir.show', compact('parkir'));
    }

    public function edit(Parkir $parkir)
    {
        return view('parkir.edit', compact('parkir'));
    }

    public function update(Request $request, Parkir $parkir)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required',
            'jenis_kendaraan' => 'required',
            'waktu_masuk' => 'required|date',
            'waktu_keluar' => 'nullable|date',
        ]);
        $parkir->update($validated);
        return redirect()->route('parkir.index')->with('success', 'Data parkir berhasil diupdate.');
    }

    public function destroy(Parkir $parkir)
    {
        $parkir->delete();
        return redirect()->route('parkir.index')->with('success', 'Data parkir berhasil dihapus.');
    }

    public function keluar(Request $request, Parkir $parkir)
    {
        $waktuKeluar = now();
        $durasi = $waktuKeluar->diffInMinutes($parkir->waktu_masuk);
        $tarifPerJam = 2000; // bisa diubah sesuai kebutuhan
        $biaya = $tarifPerJam * ceil($durasi / 60);
        $parkir->update([
            'waktu_keluar' => $waktuKeluar,
            'biaya_parkir' => $biaya,
        ]);
        return redirect()->back()->with(['barcode' => $parkir->kode_barcode, 'biaya_parkir' => $biaya]);
    }

    public function masuk(Parkir $parkir)
    {
        $parkir->update([
            'waktu_keluar' => null,
        ]);
        return redirect()->route('parkir.index')->with('success', 'Kendaraan masuk ulang.');
    }
}

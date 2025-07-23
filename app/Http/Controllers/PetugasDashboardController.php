<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parkir;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        $totalParkir = Parkir::count();
        $masukHariIni = Parkir::whereDate('waktu_masuk', today())->count();
        $keluarHariIni = Parkir::whereDate('waktu_keluar', today())->count();
        $masihParkir = Parkir::whereNull('waktu_keluar')->count();
        $parkirHariIni = \App\Models\Parkir::whereDate('waktu_masuk', today())->orderBy('waktu_masuk', 'desc')->get();
        // Hitung biaya parkir untuk setiap data keluar
        foreach ($parkirHariIni as $p) {
            if ($p->waktu_keluar) {
                $durasi = \Carbon\Carbon::parse($p->waktu_masuk)->diffInMinutes(\Carbon\Carbon::parse($p->waktu_keluar));
                $tarifPerJam = 2000; // contoh tarif per jam
                $p->biaya_parkir = $tarifPerJam * ceil($durasi / 60);
            } else {
                $p->biaya_parkir = null;
            }
        }
        return view('petugas.dashboard', compact('totalParkir', 'masukHariIni', 'keluarHariIni', 'masihParkir', 'parkirHariIni'));
    }
} 
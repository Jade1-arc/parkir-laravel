<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Parkir;
use Carbon\Carbon;

class DashboardStats extends Component
{
    public $totalParkir;
    public $masukHariIni;
    public $keluarHariIni;
    public $masihParkir;

    public function mount()
    {
        $today = Carbon::today();
        $this->totalParkir = Parkir::count();
        $this->masukHariIni = Parkir::whereDate('waktu_masuk', $today)->count();
        $this->keluarHariIni = Parkir::whereDate('waktu_keluar', $today)->count();
        $this->masihParkir = Parkir::whereNull('waktu_keluar')->count();
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}

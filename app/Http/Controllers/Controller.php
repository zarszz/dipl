<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Pembayaran;
use App\Models\Ticketing;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        $usersCount = User::count();
        $barangCount = Barang::count();
        $gudangCount = Gudang::count();
        $logCount = AuditLog::count();

        $latestTicketing = Ticketing::orderBy('created_at', 'ASC')->take(5)->get();
        $latestUnverifiedUser = User::where('status', 'unverified')->orderBy('created_at', 'ASC')->take(5)->get();
        $latestPembayaran = Pembayaran::orderBy('created_at', 'ASC')->take(5)->get();

        return view('dashboard', compact('usersCount', 'barangCount', 'gudangCount', 'logCount', 'latestTicketing', 'latestUnverifiedUser', 'latestPembayaran'));
    }
}

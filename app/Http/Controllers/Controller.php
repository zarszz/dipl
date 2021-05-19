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
        $isAdmin = auth()->user()->isAdmin();
        $usersCount = $isAdmin ? User::count() : '';
        $barangCount = $isAdmin ? Barang::count() : Barang::where('user_id', auth()->user()->id)->count();
        $gudangCount = Gudang::count();
        $logCount = $isAdmin ? AuditLog::count() : AuditLog::where('user_id', auth()->user()->id)->count();

        $latestTicketing = $isAdmin ? Ticketing::orderBy('created_at', 'ASC')->take(5)->get()
            : Ticketing::where('user_id', auth()->user()->id)->orderBy('created_at', 'ASC')->take(5)->get();

        $latestUnverifiedUser = $isAdmin ? User::where('status', 'unverified')->orderBy('created_at', 'ASC')->take(5)->get() : '';

        $latestPembayaran = $isAdmin ? Pembayaran::orderBy('created_at', 'ASC')->take(5)->get()
        : Pembayaran::where('user_id', auth()->user()->id)->orderBy('created_at', 'ASC')->take(5)->get();

        return view('dashboard', compact('usersCount', 'barangCount', 'gudangCount', 'logCount', 'latestTicketing', 'latestUnverifiedUser', 'latestPembayaran'));
    }
}

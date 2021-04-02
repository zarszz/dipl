<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Kategori' => 'App\Policies\KategoriPolicy',
        'App\Models\Ruangan' => 'App\Policies\RuanganPolicy',
        'App\Models\Kendaraan' => 'App\Policies\KendaraanPolicy',
        'App\Models\Pembayaran' => 'App\Policies\PembayaranPolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\UserRole' => 'App\Policies\UserRolePolicy',
        'App\Models\AuditLog' => 'App\Policies\AuditLogPolicy',
        'App\Models\Barang' => 'App\Policies\BarangPolicy',
        'App\Models\Gudang' => 'App\Policies\GudangPolicy',
        'App\Models\Ticketing' => 'App\Policies\TicketingPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy'
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

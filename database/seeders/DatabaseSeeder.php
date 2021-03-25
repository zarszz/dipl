<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GudangSeeder::class,
            RuanganSeeder::class,
            KategoriSeeder::class,
            KendaraanSeeder::class,
            BarangSeeder::class,
            PembayaranSeeder::class,
            TicketingSeeder::class,
            AuditLogSeeder::class
        ]);
    }
}

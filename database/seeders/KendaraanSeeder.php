<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kendaraan::create([
            'nama_kendaraan' => 'Bus 01',
            'plat_nomor' => 'D 12131321 XS',
            'kapasitas' => 100,
            'kapasitas_terpakai' => 0,
        ]);

        Kendaraan::create([
            'nama_kendaraan' => 'Bus 01',
            'plat_nomor' => 'D 535354 XS',
            'kapasitas' => 125,
            'kapasitas_terpakai' => 0,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ruangan::create([
            'nama_ruangan' => 'RUANGAN 1 GUDANG 1',
            'kode_ruangan' => 'GDG1.001',
            'kode_gudang' => 1
        ]);
        Ruangan::create([
            'nama_ruangan' => 'RUANGAN 2 GUDANG 1',
            'kode_ruangan' => 'GDG1.002',
            'kode_gudang' => 1
        ]);
        Ruangan::create([
            'nama_ruangan' => 'RUANGAN 1 GUDANG 2',
            'kode_ruangan' => 'GDG2.001',
            'kode_gudang' => 2
        ]);
        Ruangan::create([
            'nama_ruangan' => 'RUANGAN 2 GUDANG 2',
            'kode_ruangan' => 'GDG2.002',
            'kode_gudang' => 2
        ]);
    }
}

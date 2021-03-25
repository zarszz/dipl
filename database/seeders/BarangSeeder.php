<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'user_id' => 2,
            'kode_gudang' => 1,
            'nama_brg' => 'barang si ucok 1',
            'jenis_brg' => 'elektronik',
            'jumlah_brg' => 12
        ]);

        Barang::create([
            'user_id' => 2,
            'kode_gudang' => 1,
            'nama_brg' => 'barang si ucok 2',
            'jenis_brg' => 'elektronik',
            'jumlah_brg' => 12
        ]);
    }
}

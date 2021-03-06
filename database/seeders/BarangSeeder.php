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
            'user_id' => 3,
            'kode_gudang' => 1,
            'kode_ruangan' => 1,
            'nama_brg' => 'barang si ucok 1',
            'kode_kategori' => 1,
            'kode_kendaraan' => 1,
            'jumlah_brg' => 12
        ]);

        Barang::create([
            'user_id' => 3,
            'kode_gudang' => 1,
            'kode_ruangan' => 2,
            'nama_brg' => 'barang si ucok 2',
            'kode_kategori' => 1,
            'kode_kendaraan' => 1,
            'jumlah_brg' => 12
        ]);

        Barang::create([
            'user_id' => 4,
            'kode_gudang' => 1,
            'kode_ruangan' => 2,
            'nama_brg' => 'furniture otong',
            'kode_kategori' => 1,
            'kode_kendaraan' => 1,
            'jumlah_brg' => 1
        ]);

        Barang::create([
            'user_id' => 4,
            'kode_gudang' => 1,
            'kode_ruangan' => 2,
            'nama_brg' => 'jendela spesial otong',
            'kode_kategori' => 1,
            'kode_kendaraan' => 1,
            'jumlah_brg' => 1
        ]);
    }
}

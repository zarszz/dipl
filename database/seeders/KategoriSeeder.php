<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'kategori' => 'elektronik',
            'deskripsi' => 'barang elektronik'
        ]);
        Kategori::create([
            'kategori' => 'furnitur',
            'deskripsi' => 'barang furnitur'
        ]);
    }
}

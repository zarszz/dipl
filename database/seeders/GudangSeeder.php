<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Seeder;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gudang::create([
            'nama_gudang' => 'Gudang alamat soleh',
            'alamat' => 'buah batu'
        ]);
        Gudang::create([
            'nama_gudang' => 'Gudang barokah 001',
            'alamat' => 'bojongsoang'
        ]);
    }
}

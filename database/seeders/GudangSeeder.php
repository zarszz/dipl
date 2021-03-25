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
            'alamat' => 'buah batu'
        ]);
        Gudang::create([
            'alamat' => 'bojongsoang'
        ]);
    }
}

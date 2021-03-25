<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pembayaran::create([
            'tgl_bayar' => Carbon::now(),
            'no_bayar' => Str::uuid(),
            'id_bayar' => Str::uuid(),
            'jumlah_bayar' => 1000000,
            'user_id' => 2
        ]);
        Pembayaran::create([
            'tgl_bayar' => Carbon::now(),
            'no_bayar' => Str::uuid(),
            'id_bayar' => Str::uuid(),
            'jumlah_bayar' => 1500000,
            'user_id' => 3
        ]);
    }
}

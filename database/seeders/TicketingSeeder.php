<?php

namespace Database\Seeders;

use App\Models\Ticketing;
use Illuminate\Database\Seeder;

class TicketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticketing::create([
            'user_id' => 2,
            'pesan' => 'hello, ini saya ucok, saya ingin menambahkan barang dengan id 1 dan 2'
        ]);

        Ticketing::create([
            'user_id' => 3,
            'pesan' => 'hello, ini saya otong, saya ingin melakukan konfirmasi pembayaran'
        ]);
    }
}

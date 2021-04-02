<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'admin',
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', '23-5-1980'),
            'password' => Hash::make('password'),
            'alamat' => 'ciendog babakan kampret',
            'jenis_kelamin' => 'pria',
            'role_id' => 1,
            'email' => 'admin@email.com'
        ]);

        User::create([
            'nama' => 'ucok',
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', '6-2-1987'),
            'password' => Hash::make('password'),
            'alamat' => 'ciendog babakan kampret',
            'jenis_kelamin' => 'pria',
            'role_id' => 2,
            'email' => 'ucok@email.com'
        ]);

        User::create([
            'nama' => 'otong',
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', '10-10-1999'),
            'password' => Hash::make('password'),
            'alamat' => 'ciendog babakan kampret',
            'jenis_kelamin' => 'pria',
            'role_id' => 2,
            'email' => 'otong@email.com'
        ]);

        User::create([
            'nama' => 'driver',
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', '10-10-1999'),
            'password' => Hash::make('password'),
            'alamat' => 'ciendog babakan kampret',
            'jenis_kelamin' => 'pria',
            'role_id' => 3,
            'email' => 'driver@email.com'
        ]);
    }
}

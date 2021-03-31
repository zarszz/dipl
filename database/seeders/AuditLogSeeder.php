<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AuditLog::create([
            'kode_gudang' => 1,
            'kode_barang' => 1,
            'kode_kendaraan' => 1,
            'user_id' => 2,
            'aksi' => 'menyimpan barang',
            'keterangan' => 'user berhasil mengisi data barang'
        ]);

        AuditLog::create([
            'kode_gudang' => 1,
            'kode_barang' => 2,
            'kode_kendaraan' => 1,
            'user_id' => 2,
            'aksi' => 'menyimpan barang',
            'keterangan' => 'user berhasil mengisi data barang'
        ]);

        AuditLog::create([
            'kode_gudang' => 1,
            'kode_barang' => 3,
            'kode_kendaraan' => 1,
            'user_id' => 2,
            'aksi' => 'menyimpan barang',
            'keterangan' => 'user berhasil mengisi data barang'
        ]);
    }
}

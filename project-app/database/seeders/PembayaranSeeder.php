<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembayaran')->insert([
            [
                'tanggal_pembayaran' => Carbon::parse('2024-11-01'),
                'jumlah' => 5000,
                'siswa_id' => 1,
                'status_pembayaran' => true,
                'deskripsi' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pembayaran' => Carbon::parse('2024-11-10'),
                'jumlah' => 3000,
                'siswa_id' => 2,
                'status_pembayaran' => false,
                'deskripsi' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_pembayaran' => Carbon::parse('2024-11-15'),
                'jumlah' => 7000,
                'siswa_id' => 3,
                'status_pembayaran' => true,
                'deskripsi' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

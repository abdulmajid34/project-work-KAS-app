<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('siswa')->insert([
            [
                'user_id' => 1,
                'kelas_id' => 1,
                'nama_lengkap' => 'Budi Santoso',
                'nim' => '12345678901',
                'tanggal_lahir' => Carbon::parse('2005-06-15'),
                'jenis_kelamin' => 'L',
                'status' => true,
                'alamat' => 'Jl. Mawar No. 10, Jakarta',
                'agama' => '1',
                'email' => "siswa_test1@test.com",
                'tentang_saya' => '',
                'no_watshapp' => '0808080808008',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'kelas_id' => 1,
                'nama_lengkap' => 'Siti Aminah',
                'nim' => '12345678902',
                'tanggal_lahir' => Carbon::parse('2006-04-20'),
                'jenis_kelamin' => 'P',
                'status' => true,
                'alamat' => 'Jl. Melati No. 15, Bandung',
                'agama' => '2',
                'email' => "siswa_test2@test.com",
                'tentang_saya' => '',
                'no_watshapp' => '0808080808008',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'kelas_id' => 1,
                'nama_lengkap' => 'Ahmad Fauzan',
                'nim' => '12345678903',
                'tanggal_lahir' => Carbon::parse('2004-12-05'),
                'jenis_kelamin' => 'L',
                'status' => false,
                'alamat' => 'Jl. Anggrek No. 20, Surabaya',
                'agama' => '3',
                'email' => "siswa_test3@test.com",
                'tentang_saya' => '',
                'no_watshapp' => '0808080808008',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'user_id' => 6,
            //     'kelas_id' => 1,
            //     'nama_lengkap' => 'Fikri',
            //     'nim' => '12345678904',
            //     'tanggal_lahir' => Carbon::parse('2002-12-05'),
            //     'jenis_kelamin' => 'L',
            //     'status' => true,
            //     'alamat' => 'Bogor',
            //     'agama' => '1',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'user_id' => 7,
            //     'kelas_id' => 1,
            //     'nama_lengkap' => 'Steven',
            //     'nim' => '12345678905',
            //     'tanggal_lahir' => Carbon::parse('2002-12-05'),
            //     'jenis_kelamin' => 'L',
            //     'status' => true,
            //     'alamat' => 'Tangsel',
            //     'agama' => '2',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}

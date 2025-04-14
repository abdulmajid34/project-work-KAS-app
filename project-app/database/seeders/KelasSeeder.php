<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'user_id' => 1,
                'kode_kelas' => '02TPLP004',
                'no_ruangan' => '303',
                'fakultas' => 'Ilmu Komputer',
                'program_studi' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

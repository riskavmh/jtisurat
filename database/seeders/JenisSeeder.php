<?php

namespace Database\Seeders;

use App\Models\jenis;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'TA',
                'ket' => 'Survey Tugas Akhir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'PK',
                'ket' => 'Praktek Kerja Lapang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'MK',
                'ket' => 'Mata Kuliah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}

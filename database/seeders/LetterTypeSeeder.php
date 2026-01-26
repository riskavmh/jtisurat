<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('letter_type')->insert([
            [
                'id' => Str::uuid(),
                'abbr' => 'TA',
                'expan' => 'Survey Tugas Akhir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'abbr' => 'PK',
                'expan' => 'Praktek Kerja Lapang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'abbr' => 'MK',
                'expan' => 'Mata Kuliah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO colleges VALUES(
            1,
            "CCS",
            "College Of Computing Studies",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO colleges VALUES(
            2,
            "COE",
            "College Of Engineering",
            NOW(),
            NOW()
        );');
    }
}

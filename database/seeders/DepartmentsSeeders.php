<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO departments VALUES(
            1,
            1,
            "BSCS",
            "Bachelor of Science in Computer Science",
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO departments VALUES(
            2,
            1,
            "BSIT",
            "Bachelor of Science in Information Technology",
            NOW(),
            NOW()
        );');
    }
}

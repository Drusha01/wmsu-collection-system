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
            NULL,
            1,
            "BSCS",
            "Bachelor of Science in Computer Science",
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO departments VALUES(
            NULL,
            1,
            "BSIT",
            "Bachelor of Science in Information Technology",
            1,
            NOW(),
            NOW()
        );');
         DB::statement('INSERT INTO departments VALUES(
            NULL,
            2,
            "BSME",
            "Bachelor of Science in Mechanical Engineering",
            1,
            NOW(),
            NOW()
        );');
    }
}

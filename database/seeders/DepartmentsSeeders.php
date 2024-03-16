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
            15,
            "BSCS",
            "Bachelor of Science in Computer Science",
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO departments VALUES(
            NULL,
            15,
            "BSIT",
            "Bachelor of Science in Information Technology",
            1,
            NOW(),
            NOW()
        );');
         DB::statement('INSERT INTO departments VALUES(
            NULL,
            15,
            "BSACT",
            "Associate in Computer Technology",
            1,
            NOW(),
            NOW()
        );');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Semesters extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO semesters VALUES(
            NULL,
            "1st Semester",
            NOW(),
            NOW()
        );');
         DB::statement('INSERT INTO semesters VALUES(
            NULL,
            "2nd Semester",
            NOW(),
            NOW()
        );');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO school_years VALUES(
            NULL,
            CONCAT(YEAR(NOW())-1," - ",YEAR(NOW())),
            NOW(),
            NOW()
        );');
         DB::statement('INSERT INTO school_years VALUES(
            NULL,
            CONCAT(YEAR(NOW())," - ",YEAR(NOW())+1),
            NOW(),
            NOW()
        );');
    }
}

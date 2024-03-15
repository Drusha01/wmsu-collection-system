<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Mayor",
            NOW(),
            NOW()),
            (NULL,
            "Vice Mayor",
            NOW(),
            NOW()),
            (NULL,
            "Treasurer",
            NOW(),
            NOW()),
            (NULL,
            "Secretary",
            NOW(),
            NOW()),
            (NULL,
            "Collector",
            NOW(),
            NOW());');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO roles VALUES(
            NULL,
            "admin",
            NOW(),
            NOW()),
            (NULL,
            "usc-admin",
            NOW(),
            NOW()),
            (NULL,
            "csc-admin",
            NOW(),
            NOW());');
    }
}

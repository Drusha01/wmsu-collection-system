<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('INSERT INTO users VALUES(
            NULL,
            "Hanrickson",
            "E.",
            "Dumapit",
            "Admin",
            "'.bcrypt('123').'",
            0,
            1,
            0,
            0,
            1,
            NOW(),
            NOW()
        );');
        


    }
}

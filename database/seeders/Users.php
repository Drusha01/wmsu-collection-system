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
            1,
            1,
            2,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO users VALUES(
            NULL,
            "Hanrickson",
            "E.",
            "Dumapit",
            "Officer",
            "'.bcrypt('123').'",
            1,
            1,
            1,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO users VALUES(
            NULL,
            "Hanrickson",
            "E.",
            "Dumapit",
            "Collector",
            "'.bcrypt('123').'",
            1,
            1,
            3,
            1,
            NOW(),
            NOW()
        );');


    }
}

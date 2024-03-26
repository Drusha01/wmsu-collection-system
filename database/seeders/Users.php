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
        DB::statement('INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `school_year_id`, `role_id`, `college_id`, `position_id`, `is_active`, `date_created`, `date_updated`) VALUES
        (1, " Western Mindanao", "", "State University", "Admin", "$2y$12$qBTXcqyNi8NmB0pAgh6F6udwmWrjOHfsrPNTU8XMGlj/WD0ObX0Yy", 0, 1, 0, 0, 1, "2024-03-18 21:29:04", "2024-03-18 21:29:04"),
        (2, " Rylle Darryll", "T.", "Estrella", "usc", "$2y$12$tz1WdFKfyt1.uQ0L28FesectIoLcFt.fp.36ccZndlqqMuFGbFACO", 1, 2, NULL, 1, 1, "2024-03-18 21:29:28", "2024-03-18 21:29:28"),
        (3, "Alyzza", "T.", "Tingkasan", "csc", "$2y$12$bhn5OsWUjzGmgs.0b3cW9.gPv2493VPtOcJqLnfmXmVizf1eTLibu", 1, 3, 15, 4, 1, "2024-03-18 21:29:42", "2024-03-18 21:29:42");');



    }
}

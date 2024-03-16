<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE TABLE positions(
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(100) UNIQUE,
            role_id INT,
            number INT DEFAULT 1,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "University President",
            2,
            1,
            NOW(),
            NOW()
        );');

        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "University Vice-president",
            2,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Senator",
            2,
            10,
            NOW(),
            NOW()
        );');




        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Mayor",
            3,
            1,
            NOW(),
            NOW()
        );');

        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Vice Mayor",
            3,
            1,
            NOW(),
            NOW()
        );');

        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Secretary",
            3,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Treasurer",
            3,
            1,
            NOW(),
            NOW()
        );');

        DB::statement('INSERT INTO positions VALUES(
            NULL,
            "Collector",
            3,
            1,
            NOW(),
            NOW()
        );');
        DB::statement('CREATE INDEX idx_department_name ON positions(name(10));');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};

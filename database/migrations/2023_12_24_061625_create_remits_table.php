<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE TABLE remits(
            id INT PRIMARY KEY AUTO_INCREMENT,
            school_year_id INT NOT NULL,
            semester_id INT NOT NULL, 
            college_id INT NOT NULL,
            amount DOUBLE NOT NULL,
            remitted_by INT NOT NULL,
            remitted_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            appoved_by INT,
            approved_date DATETIME,
            remit_photo VARCHAR(100),
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remits');
    }
};

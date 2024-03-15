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
        DB::statement('CREATE TABLE fees(
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL ,
            code VARCHAR(100) UNIQUE,
            fee_type_id INT,
            amount DOUBLE NOT NULL,
            school_year_id INT NOT NULL,
            semester_id INT NOT NULL,
            start_date DATETIME NOT NULL,
            end_date DATETIME NOT NULL,

            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_fees_code ON fees(code(10));');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};

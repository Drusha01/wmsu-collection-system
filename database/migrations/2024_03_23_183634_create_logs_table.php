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
        DB::statement('CREATE TABLE logs(
            id INT PRIMARY KEY AUTO_INCREMENT,
            log_type_id INT,
            created_by INT,
            school_year_id INT DEFAULT NULL,
            college_id INT DEFAULT NULL,
            log_details VARCHAR(1028),
            link VARCHAR(255),
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_logs_log_type_id ON logs(log_type_id);');
        DB::statement('CREATE INDEX idx_logs_created_by ON logs(created_by);');
        DB::statement('CREATE INDEX idx_logs_school_year_id ON logs(school_year_id);');
        DB::statement('CREATE INDEX idx_logs_college_id ON logs(college_id);');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};

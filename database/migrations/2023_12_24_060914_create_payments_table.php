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
        DB::statement('CREATE TABLE payments(
            id INT PRIMARY KEY AUTO_INCREMENT,
            student_id INT,
            semester_id INT, 
            school_year_id INT,
            amount DOUBLE NOT NULL,
            collected_by INT,
            promisory_note VARCHAR(100) DEFAULT NULL,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_payments_student_id ON payments(student_id);');
        DB::statement('CREATE INDEX idx_payments_semester_id ON payments(semester_id);');
        DB::statement('CREATE INDEX idx_payments_school_year_id ON payments(school_year_id);');
        DB::statement('CREATE INDEX idx_payments_collected_by ON payments(collected_by);');
        DB::statement('CREATE INDEX idx_payments_promisory_note ON payments(promisory_note(10));');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

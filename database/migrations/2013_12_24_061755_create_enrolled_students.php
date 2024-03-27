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
        DB::statement('CREATE TABLE enrolled_students(
            id INT PRIMARY KEY AUTO_INCREMENT,
            student_id INT,
            school_year_id INT NOT NULL,
            semester_id INT NOT NULL,
            college_id INT,
            department_id INT ,
            year_level_id INT ,
            payment_status INT DEFAULT 1,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_enrolled_student_id ON enrolled_students(student_id);');
        DB::statement('CREATE INDEX idx_enrolled_school_year_id ON enrolled_students(school_year_id);');
        DB::statement('CREATE INDEX idx_enrolled_semester_id ON enrolled_students(semester_id);');
        DB::statement('CREATE INDEX idx_enrolled_college_id ON enrolled_students(college_id);');
        DB::statement('CREATE INDEX idx_enrolled_department_id ON enrolled_students(department_id);');
        DB::statement('CREATE INDEX idx_enrolled_year_level_id ON enrolled_students(year_level_id);');
        DB::statement('CREATE INDEX idx_enrolled_payment_status ON enrolled_students(payment_status);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolled_students');
    }
};

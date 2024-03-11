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
        DB::statement('CREATE TABLE students(
            id INT PRIMARY KEY AUTO_INCREMENT,
            student_code VARCHAR(100) UNIQUE,
            first_name VARCHAR(255)  NOT NULL,
            middle_name VARCHAR(255) ,
            email VARCHAR(100) UNIQUE,
            last_name VARCHAR(255) NOT NULL,
            college_id INT,
            department_id INT,

            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_user_college_id ON students(college_id);');
        DB::statement('CREATE INDEX idx_user_department_id ON students(department_id);');
        DB::statement('CREATE INDEX idx_user_email ON students(email(10));');
        DB::statement('CREATE INDEX idx_user_student_code ON students(student_code(10));');
        
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

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
            code VARCHAR(100),
            fee_type_id INT,
            amount DOUBLE NOT NULL,
            school_year_id INT NOT NULL,
            semester_id INT NOT NULL,
            is_active BOOL DEFAULT 1,
            created_by INT,
            college_id INT DEFAULT 0,
            department_id INT DEFAULT 0,
            for_muslim BOOL DEFAULT 0,

            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');

        DB::statement('CREATE INDEX idx_fees_code ON fees(code(10));');
        DB::statement('CREATE INDEX idx_fees_name ON fees(name(10));');
        DB::statement('CREATE INDEX idx_fees_fee_type_id ON fees(fee_type_id);');
        DB::statement('CREATE INDEX idx_fees_school_year_id ON fees(school_year_id);');
        DB::statement('CREATE INDEX idx_fees_semester_id ON fees(semester_id);');
        DB::statement('CREATE INDEX idx_fees_created_by ON fees(created_by);');
        DB::statement('CREATE INDEX idx_fees_college_id ON fees(college_id);');
        DB::statement('CREATE INDEX idx_fees_department_id ON fees(department_id);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};

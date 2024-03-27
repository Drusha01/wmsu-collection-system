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
        DB::statement('CREATE INDEX idx_remits_school_year_id ON remits(school_year_id);');
        DB::statement('CREATE INDEX idx_remits_semester_id ON remits(semester_id);');
        DB::statement('CREATE INDEX idx_remits_college_id ON remits(college_id);');
        DB::statement('CREATE INDEX idx_remits_remitted_by ON remits(remitted_by);');
        DB::statement('CREATE INDEX idx_remits_appoved_by ON remits(appoved_by);');
        DB::statement('CREATE INDEX idx_remits_remit_photo ON remits(remit_photo(10));');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remits');
    }
};

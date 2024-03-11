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
        DB::statement('CREATE TABLE users(
            id INT PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            middle_name VARCHAR(255),
            last_name VARCHAR(255) NOT NULL,
            username VARCHAR(100) UNIQUE,
            password VARCHAR(255) NOT NULL,
            is_active BOOL DEFAULT 1,
            college_id INT,
            role_id INT,
            position_id INT,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        
        DB::statement('CREATE INDEX idx_user_password ON users(password(10));');
        DB::statement('CREATE INDEX idx_user_username ON users(username(10));');
        DB::statement('CREATE INDEX idx_user_college_id ON users(college_id);');
        DB::statement('CREATE INDEX idx_user_role_id ON users(role_id);');
        DB::statement('CREATE INDEX idx_user_position_id ON users(position_id);');
        
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

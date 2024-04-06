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
        DB::statement('CREATE TABLE table_filters(
            id INT PRIMARY KEY AUTO_INCREMENT,
            table_id INT NOT NULL,
            user_id INT NOT NULL,
            filter_content VARCHAR(2048),
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_table_filters_table_id ON table_filters(table_id);');
        DB::statement('CREATE INDEX idx_table_filters_user_id ON table_filters(user_id);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_filters');
    }
};

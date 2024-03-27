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
        DB::statement('CREATE TABLE payment_items(
            id INT PRIMARY KEY AUTO_INCREMENT,
            payment_id INT,
            fee_id INT ,
            student_id INT, 
            amount DOUBLE NOT NULL,
            collected_by INT,
            date_created DATETIME DEFAULT CURRENT_TIMESTAMP,
            date_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );');
        DB::statement('CREATE INDEX idx_payment_items_payment_id ON payment_items(payment_id);');
        DB::statement('CREATE INDEX idx_payment_items_fee_id ON payment_items(fee_id);');
        DB::statement('CREATE INDEX idx_payment_items_student_id ON payment_items(student_id);');
        DB::statement('CREATE INDEX idx_payment_items_collected_by ON payment_items(collected_by);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};

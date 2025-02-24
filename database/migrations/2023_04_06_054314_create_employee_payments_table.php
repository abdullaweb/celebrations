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
        Schema::create('employee_payments', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('ot_hour')->nullable();
            $table->double('ot_payment')->nullable();
            $table->double('bonus')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('basic_salary')->nullable();
            $table->double('payable_amount')->nullable();
            $table->date('effected_date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->double('advanced_amount')->default('0');
            $table->double('total_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_payments');
    }
};

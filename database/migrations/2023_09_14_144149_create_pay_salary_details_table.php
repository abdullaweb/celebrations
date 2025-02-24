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
        Schema::create('pay_salary_details', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('paid_date')->nullable();
            $table->string('paid_month')->nullable();
            $table->string('paid_year')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('paid_type')->nullable();
            $table->string('voucher_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_salary_details');
    }
};

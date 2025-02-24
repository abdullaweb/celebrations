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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('paid_status',51)->nullable();
            $table->string('paid_source')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('due_amount')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('sub_total')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('vat_tax')->nullable();
            $table->double('vat_amount')->nullable();
            $table->longText('check_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

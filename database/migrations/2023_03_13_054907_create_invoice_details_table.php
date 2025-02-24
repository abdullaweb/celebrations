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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->string('invoice_no_gen')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_cat_id')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('selling_qty')->nullable();
            $table->string('size')->nullable();
            $table->string('size_width')->nullable();
            $table->string('size_length')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=customer, 1= company');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};

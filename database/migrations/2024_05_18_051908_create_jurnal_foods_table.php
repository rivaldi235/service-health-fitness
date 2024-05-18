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
        Schema::create('jurnal_foods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_jurnal_food_id');
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('total_serving');
            $table->timestamps();

            $table->foreign('category_jurnal_food_id')->references('id')->on('category_jurnal_foods')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal_foods');
    }
};

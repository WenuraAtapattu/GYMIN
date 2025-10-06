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
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_plan_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack']);
            $table->json('foods');
            $table->integer('total_calories');
            $table->json('macros');
            $table->integer('preparation_time'); // in minutes
            $table->json('instructions');
            $table->json('ingredients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plans');
    }
};

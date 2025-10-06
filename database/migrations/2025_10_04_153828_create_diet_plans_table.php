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
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->enum('goal_type', ['weight_loss', 'weight_gain', 'muscle_building', 'maintenance']);
            $table->integer('total_calories');
            $table->json('macros'); // protein, carbs, fats percentages
            $table->json('meal_plans')->nullable();
            $table->integer('duration_weeks');
            $table->boolean('is_public')->default(false);
            $table->boolean('created_by_trainer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
    }
};

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
        Schema::table('carts', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['package_id']);
            
            // Add the new foreign key constraint pointing to products table
            $table->foreign('package_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['package_id']);
            
            // Restore the original foreign key constraint to packages table
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }
};

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
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key constraint for package_id
            $table->dropForeign(['package_id']);
            
            // Rename package_id to product_id
            $table->renameColumn('package_id', 'product_id');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            // Add foreign key constraint for product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the foreign key constraint for product_id
            $table->dropForeign(['product_id']);
            
            // Rename product_id back to package_id
            $table->renameColumn('product_id', 'package_id');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            // Add foreign key constraint for package_id
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }
};

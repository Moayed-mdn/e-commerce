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
        Schema::create('product_item_attribute_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_item_id')->constrained('product_items')->cascadeOnDelete();
            $table->foreignId('product_attribute_option_id')->constrained('product_attribute_options', 'id', 'fk_item_attr_opt')->cascadeOnDelete(); 
            $table->unique(['product_item_id','product_attribute_option_id'],'item_attribute_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_item_attribute_options');
    }
};

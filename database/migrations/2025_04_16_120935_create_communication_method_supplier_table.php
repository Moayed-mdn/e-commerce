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
        Schema::create('communication_method_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->foreignId('communication_method_id')->constrained('communication_methods')->cascadeOnDelete();
            $table->string('contact_detail')->unique();
            $table->unique(['supplier_id','communication_method_id'],'supplier_comm_method_unique'); //{table_name}_{column_1}_{column_2}_unique
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_method_supplier');
    }
};

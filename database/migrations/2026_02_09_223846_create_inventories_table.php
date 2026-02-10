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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            // Relacionamentos
            $table->foreignId('chemical_product_id')->constrained()->onDelete('cascade');
            $table->foreignId('storage_id')->constrained()->onDelete('cascade');
            
            // Dados do estoque
            $table->decimal('quantity', 10, 2);
            $table->string('unit')->default('un'); // un, kg, L
            $table->string('lot_number')->nullable();
            $table->date('expiration_date')->nullable(); // Campo de validade solicitado
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

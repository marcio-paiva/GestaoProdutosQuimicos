<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chemical_products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do produto
            $table->string('cas_number')->nullable(); // Registro CAS (padrão químico)
            $table->string('formula')->nullable(); // Fórmula Química
            $table->text('description')->nullable();
            $table->string('risk_level')->default('Baixo'); // Nível de risco
            $table->boolean('is_approved')->default(false); // Status da avaliação
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chemical_products');
    }
};
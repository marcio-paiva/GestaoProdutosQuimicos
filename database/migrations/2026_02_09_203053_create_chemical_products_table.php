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
            $table->string('name'); 
            $table->string('cas_number')->nullable(); 
            $table->string('formula')->nullable(); 
            $table->text('description')->nullable();
            $table->string('risk_level')->default('Baixo'); 
            $table->boolean('is_approved')->default(false);
            
            // --- ADICIONE ESTAS LINHAS ABAIXO ---
            $table->date('fds_revision_date')->nullable(); // Para a lógica de 2 anos
            $table->json('pictograms')->nullable();        // Para guardar o array de GHS
            $table->text('safety_precautions')->nullable(); // Precauções de segurança
            // ------------------------------------

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chemical_products');
    }
};
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
            $table->date('fds_revision_date')->nullable(); 
            $table->json('pictograms')->nullable();        
            $table->text('safety_precautions')->nullable(); 


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chemical_products');
    }
};
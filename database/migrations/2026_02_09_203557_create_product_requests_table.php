<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            // Relaciona com o usuário que solicitou
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Dados da solicitação baseados no seu Figma
            $table->string('product_name');
            $table->string('cas_number')->nullable();
            $table->text('justification'); // Por que precisa deste produto?
            
            // Status do Workflow
            // 'pending' (pendente), 'approved' (aprovado), 'rejected' (reprovado)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Parecer do Avaliador
            $table->text('evaluator_feedback')->nullable();
            $table->foreignId('evaluator_id')->nullable()->constrained('users');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_requests');
    }
};
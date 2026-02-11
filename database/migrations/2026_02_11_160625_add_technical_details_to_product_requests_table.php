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
        Schema::table('product_requests', function (Blueprint $table) {
            $table->string('controlled_by')->nullable(); // Exército, PF, etc.
            $table->string('product_type')->nullable(); // Tinta, Lubrificante, etc.
            $table->date('fds_revision_date')->nullable();
            $table->json('pictograms')->nullable(); // Para multiseleção (GHS01, GHS02...)
            $table->text('safety_precautions')->nullable(); // Cuidados e recomendações
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_requests', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: Almoxarifado Central, Lab 01
            $table->string('location')->nullable(); // Localização física
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('storages');
    }
};
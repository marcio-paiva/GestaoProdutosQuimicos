<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('chemical_products', function (Blueprint $table) {
            $table->date('fds_revision_date')->nullable();
            $table->json('pictograms')->nullable();
            $table->text('safety_precautions')->nullable();
            $table->string('manufacturer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chemical_products', function (Blueprint $table) {
            //
        });
    }
};

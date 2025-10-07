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
        
        Schema::create('light_novels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre', 255);
            $table->string('auteur', 255);
            $table->text('statut');
            $table->integer('chapitres');
            $table->longText('Contenu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('light_novels');
    }
};

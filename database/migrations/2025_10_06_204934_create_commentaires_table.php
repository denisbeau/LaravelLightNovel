<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->increments('id');

            // correspond au type de light_novels.id (si light_novels utilise increments => int unsigned)
            $table->unsignedInteger('Light_Novel_id');

            // users.id créé par la migration par défaut de Laravel est un BIGINT UNSIGNED
            // -> on utilise foreignId() qui crée un unsignedBigInteger compatible
            $table->foreignId('users_id');

            $table->text('texte');
            $table->boolean('efface')->default(false);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('Light_Novel_id')
                  ->references('id')
                  ->on('light_novels')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // foreignId() + constrained() ajouterait automatiquement la FK,
            // mais la ligne suivante explicite l'intention (optionnelle si tu utilises constrained())
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};

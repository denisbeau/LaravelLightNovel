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
    Schema::table('commentaires', function (Blueprint $table) {
        $table->renameColumn('Light_Novel_id', 'light_novel_id');
        $table->renameColumn('users_id', 'user_id');
    });
}

public function down(): void
{
    Schema::table('commentaires', function (Blueprint $table) {
        $table->renameColumn('light_novel_id', 'Light_Novel_id');
        $table->renameColumn('user_id', 'users_id');
    });
}

};

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
        Schema::table('light_novels', function (Blueprint $table) {
        $table->string('photo')->nullable()->after('Contenu');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('light_novels', function (Blueprint $table) {
            //
        });
    }
};

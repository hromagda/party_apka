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
        Schema::table('pisnicky', function (Blueprint $table) {
            $table->boolean('zahrano')->default(false); // Přidání sloupce pro stav "zahráno"
        });
    }

    public function down()
    {
        Schema::table('pisnicky', function (Blueprint $table) {
            $table->dropColumn('zahrano');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
          $table->unsignedBigInteger('type_id')->nullable()->after('id');
          //2. assegno FK alla colonna creata
          $table->foreign('type_id')
                ->references('id')
                ->on('types')
                //se viene eliminato un tipo in dati in relazione non vengono persi e settati come null
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
             //1. Elimino FK
          $table->dropForeign(['type_id']);

          //2. Elimino la colonna
          $table->dropColumn('type_id');
        });
    }
};

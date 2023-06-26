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
        Schema::create('project_tecnology', function (Blueprint $table) {

          //1. Relazione tabella project
          $table->unsignedBigInteger('project_id');
          //2. assegno FK alla colonna creata
          $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                //all'eliminazione di un project viene eliminata anche la relazione con tecnology
                ->cascadeOnDelete();

          //1. Relazione tabella tecnology
          $table->unsignedBigInteger('tecnology_id');
          //2. assegno FK alla colonna creata
          $table->foreign('tecnology_id')
                ->references('id')
                ->on('tecnologies')
                //all'eliminazione di un tecnology viene eliminata anche la relazione con project
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tecnology');
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('contract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Eingang');
            $table->string('title');
            $table->string('art');
            $table->string('begin');
            $table->string('end');
            $table->string('Letzter Bearbeiter');
            $table->string('communication');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

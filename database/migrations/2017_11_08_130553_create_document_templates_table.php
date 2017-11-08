<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('document_templates', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('file');
            $table->string('size');

            $table->unsignedInteger('document_type_id')->nullable();
            $table->foreign('document_type_id')->references('id')->on('document_types');

            $table->unsignedInteger('document_group_id')->nullable();
            $table->foreign('document_group_id')->references('id')->on('document_groups');

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

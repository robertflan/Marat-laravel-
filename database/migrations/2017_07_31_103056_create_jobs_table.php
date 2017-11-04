<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['Vollzeit', 'Teilzeit', 'Praktikum', 'Freiberuflich', 'Werkstudent'])->nullable();

            $table->unsignedInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
            $table->unsignedInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
            
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}

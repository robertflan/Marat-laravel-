<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedInteger('job_id')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->unsignedInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');

            $table->smallInteger('status')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('self_destroy')->default(0)->nullable();

            $table->string('recommend')->nullable();
            $table->string('source')->nullable();

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
        Schema::dropIfExists('applications');
    }
}

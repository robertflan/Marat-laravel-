<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dob')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('image')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();

            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();

            $table->string('url_linked')->nullable();
            $table->string('url_other')->nullable();

            $table->text('skills')->nullable();

            $table->text('letter')->nullable();
            $table->string('resume')->nullable();
            $table->string('testimonials')->nullable();
            $table->longText('other_documents')->nullable();

            $table->longText('qualifications')->nullable();
            $table->longText('qualification_files')->nullable();
            $table->longText('languages')->nullable();
            $table->longText('language_levels')->nullable();

            $table->boolean('self_destroy')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('company_id')->after('id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedInteger('profile_id')->after('id')->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');


            //$table->unique(['email','company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['company_id']);
            
            $table->dropForeign(['profile_id']);
            $table->dropColumn(['profile_id']);
        });

        Schema::dropIfExists('profiles');
    }
}

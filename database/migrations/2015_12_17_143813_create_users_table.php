<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id')->index();
            $table->string('username');
            $table->string('first_name');
            $table->string('surname');
            $table->string('location');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('pin');
            $table->string('company');
            $table->string('website');
            $table->longText('description');
            $table->string('city');
            $table->string('country');
            $table->string('profile_img');
            $table->string('zip_code');
            $table->integer('rate')->nullable();
            $table->string('active')->default(false);
            $table->string('hash')->nullable();
            $table->enum('role', ['seeker', 'provider','admin']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}

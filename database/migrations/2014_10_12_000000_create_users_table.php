<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('image_pass')->nullable();
            $table->integer('age')->nullable();
            $table->integer('sex')->nullable();
            $table->string('insurance_compnay')->nullable();
            $table->boolean('spouse')->nullable();
            $table->integer('children')->nullable();
            $table->integer('house_type')->nullable();
            $table->integer('pref')->nullable();
            $table->string('free_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

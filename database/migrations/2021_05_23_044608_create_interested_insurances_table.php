<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestedInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interested_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->boolean('life')->nullable();
            $table->boolean('medical')->nullable();
            $table->boolean('cancer')->nullable();
            $table->boolean('pension')->nullable();
            $table->boolean('saving')->nullable();
            $table->boolean('all_life')->nullable();
            $table->boolean('home')->nullable();
            $table->boolean('other')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interested_insurances');
    }
}

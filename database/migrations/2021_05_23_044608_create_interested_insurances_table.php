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
            $table->boolean('interested_life')->nullable();
            $table->boolean('interested_medical')->nullable();
            $table->boolean('interested_cancer')->nullable();
            $table->boolean('interested_pension')->nullable();
            $table->boolean('interested_saving')->nullable();
            $table->boolean('interested_all_life')->nullable();
            $table->boolean('interested_home')->nullable();
            $table->boolean('interested_other')->nullable();
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

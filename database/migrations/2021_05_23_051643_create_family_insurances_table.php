<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('age')->nullable();
            $table->integer('relationship');
            $table->string('have_insurance_company')->nullable();
            $table->string('have_insurance_content');
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
        Schema::dropIfExists('family_insurances');
    }
}

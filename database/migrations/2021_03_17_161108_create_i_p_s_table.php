<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_p_s', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip')->unique();
            $table->string('version');
            $table->string('city');
            $table->string('region');
            $table->string('region_code');
            $table->string('country');
            $table->string('country_name');
            $table->string('country_code');
            $table->string('country_code_iso3');
            $table->string('continent_code');
            $table->string('org');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('i_p_s');
    }
}

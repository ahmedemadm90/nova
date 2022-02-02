<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDVRSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_v_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['NVR', 'DVR']);
            $table->string('install_location');
            $table->string('region');
            $table->string('location');
            $table->string('area');
            $table->string('brand');
            $table->string('model');
            $table->string('sw_ver');
            $table->string('code');
            $table->bigInteger('total_chs');
            $table->bigInteger('hdd_cap');
            $table->bigInteger('unit_cap');
            $table->bigInteger('total_storage');
            $table->bigInteger('qty');
            $table->string('ip')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->enum('active', [0, 1]);
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
        Schema::dropIfExists('d_v_r_s');
    }
}
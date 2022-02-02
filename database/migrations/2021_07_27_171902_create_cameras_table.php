<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('region');
            $table->string('segment');
            $table->string('location');
            $table->string('area');
            $table->string('en_name');
            $table->string('ar_name');
            $table->enum('is_operation', ['operation', 'non operation']);
            $table->foreignId('switch_id')->constrained('dispatches', 'id')->onUpdate('cascade')->ondelete('no action');
            $table->foreignId('vlan_id')->constrained('vlans', 'id')->onUpdate('cascade')->ondelete('no action');
            $table->foreignId('dvr_id')->constrained('d_v_r_s', 'id')->onUpdate('cascade')->ondelete('no action');
            $table->enum('type', ['analog', 'ip fixed', 'ip ptz']);
            $table->string('brand');
            $table->string('model');
            $table->string('serial');
            $table->string('ip');
            $table->string('username');
            $table->string('password');
            $table->bigInteger('resolution', false, false);
            $table->string('maintenance');
            $table->string('clean');
            $table->string('connection');
            $table->string('power');
            $table->string('company');
            $table->bigInteger('year', false, false);
            $table->enum('install_state', ['installed', 'in progress']);
            $table->enum('state', ['online', 'offline']);
            $table->enum('alarm', ['enabled', 'disabled']);
            $table->string('ticket_id')->nullable();
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
        Schema::dropIfExists('cameras');
    }
}
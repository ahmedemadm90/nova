<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('ports');
            $table->enum('type', ['ip fixed', 'analog']);
            $table->string('location');
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
        Schema::dropIfExists('dispatches');
    }
}
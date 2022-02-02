<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('license_level', ['1st', '2nd', '3rd', 'private']);
            $table->string('license_number');
            $table->string('phone_number');
            $table->string('id_img');
            $table->enum('state', ['blacklist', 'allowed']);
            $table->enum('active', [0, 1]);
            $table->foreignId('permit_id')->nullable()->constrained('permits', 'id')->onUpdate('cascade')->onDelete('NO ACTION');
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
        Schema::dropIfExists('drivers');
    }
}
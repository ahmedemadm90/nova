<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camera_id')->nullable()->constrained('cameras', 'id')->onUpdate('cascade')->ondelete('restrict');
            $table->foreignId('device_id')->nullable()->constrained('d_v_r_s', 'id')->onUpdate('cascade')->ondelete('restrict');
            $table->string('details');
            $table->string('state')->default('open');
            $table->string('tech_comment');
            $table->foreignId('last_update_id')->constrained('users', 'id')->onupdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tickets');
    }
}
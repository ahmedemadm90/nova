<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUaeViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uae_violations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('vp_id');
            $table->string('area_id');
            $table->string('date');
            $table->string('time');
            $table->foreignId('classification')->nullable()->constrained('violation_types')->onUpdate('cascade')->onDelete('no action');
            $table->string('involved_ids');
            $table->string('involved_names');
            $table->text('description');
            $table->text('action');
            $table->text('gallery');
            $table->string('video');
            $table->string('register_by');
            $table->enum('valid',[0,1]);
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
        Schema::dropIfExists('uae__violations');
    }
}

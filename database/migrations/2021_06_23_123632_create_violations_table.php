<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vp_id')->constrained('vps')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade')->onDelete('no action');;
            $table->string('location', 50);
            $table->string('date', 10);
            $table->string('time', 5);
            $table->string('type', 25);
            $table->text('category');
            $table->integer('involved_ids');
            $table->text('involved_names');
            $table->text('involved_pos');
            $table->text('involved_comps');
            $table->text('involved_types');
            $table->foreignId('area_res_id')->constrained('workers')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('classification')->nullable()->constrained('violation_types')->onUpdate('cascade')->onDelete('no action');
            $table->integer('nearmiss');
            $table->text('description');
            $table->text('action');
            $table->enum('valid', [0, 1])->nullable();
            $table->text('safety_comment')->nullable();
            $table->string('gallery', 125);
            $table->string('video', 25);
            $table->string('register_by');
            $table->enum('valid', [0, 1]);
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
        Schema::dropIfExists('violations');
    }
}

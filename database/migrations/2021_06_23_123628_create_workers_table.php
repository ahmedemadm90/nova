<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('position', 50);
            $table->foreignId('vp_id')->constrained('vps')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('type_id')->constraind('types')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('title_id')->constraind('titles')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('company_id')->constrained('companies')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('country_id')->constraind('countries')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('location_id')->constraind('locations')->onUpdate('cascade')->onDelete('no action');
            $table->string('state', 5);
            $table->enum('area_res', [0, 1]);
            $table->string('img', 25)->nullable();
        });
        Schema::table('workers', function (Blueprint $table) {
            $table->unsignedBigInteger('worker_manager_id')->nullable()->default('1');
            $table->foreign('worker_manager_id')->references('id')->on('workers')
                ->onUpdate('cascade')->onDelete('no action')->default(1);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
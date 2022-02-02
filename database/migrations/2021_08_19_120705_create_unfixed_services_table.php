<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnfixedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unfixed_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nid');
            $table->string('job');
            $table->string('address');
            $table->string('mobile');
            $table->string('image')->nullable();
            $table->string('licence_level')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('service_companies')
                ->onUpdate('cascade')->ondelete('restrict')->default(null);
            $table->foreignId('permit_id')->nullable()->constrained('unfixed_permits')
                ->onUpdate('cascade')->ondelete('restrict')->default(null);
            $table->enum('blacklist', [0, 1])->default(0);
            $table->enum('active', [0, 1])->default(1);
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
        Schema::dropIfExists('unfixed_services');
    }
}
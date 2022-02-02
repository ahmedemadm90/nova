<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitsTable extends Migration
{
    public function up()
    {
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->string('date_from', 10);
            $table->string('date_to', 10);
            $table->string('vehicle_num', 25);
            $table->string('vehicle_type', 25);
            $table->string('vehicle_clr', 25);
            $table->string('drivers_count', 25);
            $table->text('vehicle_drivers');
            $table->text('vehicle_drivers_id');
            $table->text('drivers_id_types');
            $table->text('drivers_phones');
            $table->string('company', 50);
            $table->text('mission');
            $table->text('access_gate');
            $table->text('allowed_sectors');
            $table->text('movement_gates');
            $table->foreignId('permit_by')->constrained('workers', 'id')->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('group_id')->constrained();
            $table->string('state', 15);
            $table->string('expire', 15)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permits');
    }
}
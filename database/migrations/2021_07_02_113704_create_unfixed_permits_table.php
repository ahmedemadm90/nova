<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnfixedPermitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unfixed_permits', function (Blueprint $table) {
            $table->id();
            $table->text('workers_names');
            $table->text('workers_ids');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('company_id');
            $table->enum('active', [0, 1])->default(0);
            $table->foreignId('requested_by')->nullable()->constrained('users', 'id')->onUpdate('cascade')->onDelete('no action');
            $table->enum('manager_approve', [0, 1])->nullable();
            $table->enum('safety_approve', [0, 1])->nullable();
            $table->enum('security_approve', [0, 1])->nullable();
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
        Schema::dropIfExists('unfixed_permits');
    }
}
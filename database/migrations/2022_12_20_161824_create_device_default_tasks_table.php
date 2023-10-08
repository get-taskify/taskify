<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('device_default_tasks', function (Blueprint $table) {

            $table->id();
            $table->boolean('finished');
            $table->unsignedBigInteger('repair_object_id');
            $table->unsignedBigInteger('default_task_id');
            $table->timestamps();

            $table->foreign('repair_object_id')->references('id')->on('repair_objects')->onDelete('cascade');
            $table->foreign('default_task_id')->references('id')->on('default_tasks')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('device_default_tasks');

    }

};

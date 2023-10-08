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

        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->string('text');
            $table->boolean('finished');
            $table->unsignedBigInteger('repair_object_id');
            $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->timestamps();

            $table->foreign('repair_object_id')->references('id')->on('repair_objects')->onDelete('cascade');
            $table->foreign('done_by_user_id')->references('id')->on('users')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('tasks');

    }

};

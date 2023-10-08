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

        Schema::create('assignments', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('priority');
            $table->unsignedBigInteger('state');
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->unsignedBigInteger('repair_object_id');
            $table->timestamps();

            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('done_by_user_id')->references('id')->on('users')->onDelete('set null');;
            $table->foreign('repair_object_id')->references('id')->on('repair_objects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('assignments');
    }
};

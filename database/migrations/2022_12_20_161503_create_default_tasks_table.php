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

        Schema::create('default_tasks', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('device_type');
            $table->string('text');
            // $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->timestamps();

            // $table->foreign('done_by_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('default_tasks');
    }
};

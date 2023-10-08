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

        Schema::create('note_repair_objects', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('repair_object_id');
            $table->unsignedBigInteger('note_id');
            $table->timestamps();

            $table->foreign('repair_object_id')->references('id')->on('repair_objects')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('note_repair_objects');

    }

};

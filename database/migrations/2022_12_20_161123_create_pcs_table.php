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

        Schema::create('pcs', function (Blueprint $table) {

            $table->id();
            $table->string('brand');
            $table->string('cpu');
            $table->unsignedBigInteger('ram');
            $table->unsignedBigInteger('storage');
            $table->string('architecture');
            $table->string('bios_key');
            $table->unsignedBigInteger('pc_type');
            $table->string('system_language');
            $table->unsignedBigInteger('repair_object_id');
            $table->timestamps();

            $table->foreign('repair_object_id')->references('id')->on('repair_objects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('pcs');
    }
};

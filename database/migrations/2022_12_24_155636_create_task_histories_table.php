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

        Schema::create('task_histories', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('text');
            $table->boolean('finished');
            $table->unsignedBigInteger('repair_object_id');
            $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->string('operation');  //For Trigger: UPDATE or DELETE
            $table->timestamp('historical_timestamp');  //For Trigger: Timestamp of event

            // $table->foreign('id')->references('id')->on('tasks');
            // $table->foreign('done_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //Trigger on Update
        DB::unprepared('
               CREATE TRIGGER task_histories_update_trigger AFTER UPDATE ON tasks
               FOR EACH ROW
               BEGIN
                   IF OLD.id IS NOT NULL THEN
                       INSERT INTO task_histories (id, task_id, text, finished, repair_object_id, done_by_user_id, operation, historical_timestamp)
                       VALUES (NULL, OLD.id, OLD.text, OLD.finished, OLD.repair_object_id, OLD.done_by_user_id, "UPDATE", NOW());
                   END IF;
               END
           ');

        //Trigger on Delete
        DB::unprepared('
           CREATE TRIGGER task_histories_delete_trigger AFTER DELETE ON tasks
           FOR EACH ROW
           BEGIN
               IF OLD.id IS NOT NULL THEN
                    INSERT INTO task_histories (id, task_id, text, finished, repair_object_id, done_by_user_id, operation, historical_timestamp)
                    VALUES (NULL, OLD.id, OLD.text, OLD.finished, OLD.repair_object_id, OLD.done_by_user_id, "DELETE", NOW());
               END IF;
           END
       ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {


        DB::unprepared('DROP TRIGGER task_histories_update_trigger'); //Delete Update Trigger
        DB::unprepared('DROP TRIGGER task_histories_delete_trigger'); //Delete Delete Trigger
        Schema::dropIfExists('task_histories');
    }
};

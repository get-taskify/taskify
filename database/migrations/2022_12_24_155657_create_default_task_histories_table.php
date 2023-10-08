<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('default_task_histories', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('default_task_id');
            $table->unsignedBigInteger('device_type');
            $table->string('text');
            $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->string('operation'); //For Trigger: UPDATE or DELETE
            $table->timestamp('historical_timestamp'); //For Trigger: Timestamp of event

            // $table->foreign('id')->references('id')->on('default_tasks');
            // $table->foreign('done_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        //Trigger on Update
        DB::unprepared('
                CREATE TRIGGER default_task_histories_update_trigger AFTER UPDATE ON default_tasks
                FOR EACH ROW
                BEGIN
                    IF OLD.id IS NOT NULL THEN
                        INSERT INTO default_task_histories (id, default_task_id, device_type, text, operation, historical_timestamp, done_by_user_id)
                        VALUES (NULL, OLD.id, OLD.device_type, OLD.text, "UPDATE", NOW(), NULL);
                    END IF;
                END
            ');

        //Trigger on Delete
        DB::unprepared('
            CREATE TRIGGER default_task_histories_delete_trigger AFTER DELETE ON default_tasks
            FOR EACH ROW
            BEGIN
                IF OLD.id IS NOT NULL THEN
                    INSERT INTO default_task_histories (id, default_task_id, device_type, text, operation, historical_timestamp, done_by_user_id)
                    VALUES (NULL, OLD.id, OLD.device_type, OLD.text, "DELETE", NOW(), NULL);
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


        DB::unprepared('DROP TRIGGER default_task_histories_update_trigger'); //Delete Update Trigger
        DB::unprepared('DROP TRIGGER default_task_histories_delete_trigger'); //Delete Delete Trigger
        Schema::dropIfExists('default_task_histories');
    }
};

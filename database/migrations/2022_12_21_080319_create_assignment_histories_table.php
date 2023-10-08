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

        Schema::create('assignment_histories', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->string('name');
            $table->unsignedBigInteger('priority');
            $table->unsignedBigInteger('state');
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('done_by_user_id')->nullable();
            $table->string('operation');  //For Trigger: UPDATE or DELETE
            $table->timestamp('historical_timestamp');  //For Trigger: Timestamp of event

            // $table->foreign('id')->references('id')->on('assignments');
            // $table->foreign('done_by_user_id')->references('id')->on('users');
        });

        //Trigger on Update
        DB::unprepared('
            CREATE TRIGGER assignment_histories_update_trigger AFTER UPDATE ON assignments
            FOR EACH ROW
            BEGIN
                IF OLD.id IS NOT NULL THEN
                    INSERT INTO assignment_histories (id, assignment_id, name, priority, state, workshop_id, created_by_user_id, done_by_user_id, operation, historical_timestamp)
                    VALUES (NULL, OLD.id, OLD.name, OLD.priority, OLD.state, OLD.workshop_id, OLD.created_by_user_id, OLD.done_by_user_id, "UPDATE", NOW());
                END IF;
            END
        ');
        //Trigger on Delete
        DB::unprepared('
        CREATE TRIGGER assignment_histories_delete_trigger AFTER DELETE ON assignments
        FOR EACH ROW
        BEGIN
            IF OLD.id IS NOT NULL THEN
                INSERT INTO assignment_histories (id, assignment_id, name, priority, state, workshop_id, created_by_user_id, done_by_user_id, operation, historical_timestamp)
                VALUES (NULL, OLD.id, OLD.name, OLD.priority, OLD.state, OLD.workshop_id, OLD.created_by_user_id, OLD.done_by_user_id, "DELETE", NOW());
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

        DB::unprepared('DROP TRIGGER assignment_histories_update_trigger'); //Delete Update Trigger
        DB::unprepared('DROP TRIGGER assignment_histories_delete_trigger'); //Delete Delete Trigger
        Schema::dropIfExists('assignment_histories');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['text', 'finished', 'repair_object_id', 'done_by_user_id'];

    public static function countTasks($repair_object_id) {

        $tasks = Task::where('repair_object_id', $repair_object_id)->count();
        $tasks += Device_default_task::where('repair_object_id', $repair_object_id)->count();

        return $tasks;

    }

    public function done_by_user() {

        return $this->belongsTo(User::class);

    }

    public function repair_object() {

        return $this->hasOne(Repair_object::class);

    }

    public static function countNotfinishedtasks($repair_object_id) {

        $tasks = Task::where('repair_object_id', $repair_object_id)->where('finished', 0)->count();
        $tasks += Device_default_task::where('repair_object_id', $repair_object_id)->where('finished', 0)->count();

        return $tasks;

    }

    public static function countFinishedtasks($repair_object_id) {

        $tasks = Task::where('repair_object_id', $repair_object_id)->where('finished', 1)->count();
        $tasks += Device_default_task::where('repair_object_id', $repair_object_id)->where('finished', 1)->count();

        return $tasks;

    }

    public static function findByRepair_object($repair_object_id) {

        return Task::where('repair_object_id', $repair_object_id)->get();

    }

    public static function getTasksbyassignment($id) {

        return Task::where('repair_object_id', $id)->get();

    }

}

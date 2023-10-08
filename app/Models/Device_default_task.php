<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device_default_task extends Model {

    use HasFactory;

    protected $table = 'device_default_tasks';

    protected $fillable = ['finished', 'repair_object_id', 'default_task_id'];

    public function repair_object() {

        return $this->belongsTo(Repair_object::class);

    }

    public function default_task() {

        return $this->belongsTo(Default_task::class);

    }

    public static function findByRepair_objectDefault_task($repair_object_id, $id) {

        return Device_default_task::where('repair_object_id', $repair_object_id)->where('default_task_id', $id)->get()->first();

    }

}

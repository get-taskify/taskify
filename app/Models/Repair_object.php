<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair_object extends Model {

    use HasFactory;

    protected $table = 'repair_objects';

    protected $fillable = ['name'];

    public function assignment() {

        return $this->hasMany(Assignment::class);

    }

    public function pc() {

        return $this->hasOne(Pc::class);

    }

    public function tasks() {

        return $this->hasMany(Task::class);

    }

    public function device_default_tasks() {

        return $this->hasMany(Device_default_task::class);

    }

    public static function getName($repair_object_id) {

        return Repair_object::where('id', $repair_object_id)->value('name');

    }

}

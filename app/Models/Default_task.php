<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Default_task extends Model {

    use HasFactory;

    protected $table = 'default_tasks';

    protected $fillable = ['device_type', 'text'];

    public function device_default_tasks() {

        return $this->hasMany(Device_default_task::class);

    }

    /**
     * default_task' device_type
     *
     * @var array
     */
    protected const device_type = [
        1 => 'pc',
        2 => 'notebook'
    ];

    public static function getDevice_types() {

        return self::device_type;

    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Default_task_history extends Model {

    use HasFactory;

    protected $table = 'default_task_histories';

    protected $fillable = ['device_type', 'text', 'done_by_user_id'];

    protected static function boot() {

        parent::boot();

        static::creating(function ($model) {

            $model->done_by_user_id = Auth::id();

        });

        static::updating(function ($model) {

            $model->done_by_user_id = Auth::id();

        });

    }

}

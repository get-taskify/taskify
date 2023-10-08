<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task_history extends Model {

    use HasFactory;

    protected $table = 'task_histories';

    protected $fillable = ['text', 'finished', 'repair_object_id', 'done_by_user_id'];


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

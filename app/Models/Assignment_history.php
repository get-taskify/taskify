<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Assignment_history extends Model {

    use HasFactory;

    protected $table = 'assignment_histories';

    protected $fillable = ['name', 'priority', 'state', 'workshop_id', 'created_by_user_id', 'done_by_user_id', 'note_id'];

    protected const states = [

        1 => 'notassigned',
        2 => 'waiting',
        3 => 'inprogress',
        4 => 'paused',
        5 => 'ready',
        6 => 'done',
        7 => 'cancelled'

    ];

    protected const priorities = [

        1 => 'low',
        2 => 'medium',
        3 => 'high'

    ];

    public static function getStates() {

        return self::states;

    }

    public static function getPriorities() {

        return self::priorities;

    }

    public function getState() {

        return self::states[$this->state];

    }

    public function getPriority() {

        return self::priorities[$this->priority];

    }


    public function created_by_user() {

        return $this->belongsTo(User::class);

    }

    public function workshop() {

        return $this->belongsTo(Workshop::class);

    }

    public function done_by_user() {

        return $this->belongsTo(User::class);

    }
}

<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {

    use HasFactory;

    protected $table = 'assignments';

    protected $fillable = ['name', 'priority', 'state', 'workshop_id', 'repair_object_id', 'created_by_user_id', 'done_by_user_id', 'note_id'];

    public function repair_object() {

        return $this->belongsTo(Repair_object::class);

    }

    public function workshop() {

        return $this->belongsTo(Workshop::class);

    }

    public function done_by_user() {

        return $this->belongsTo(User::class);

    }

    public function created_by_user() {

        return $this->belongsTo(User::class);

    }

    public function tasks() {

        return $this->belongsTo(Task::class);

    }

    public function task_history() {

        return $this->belongsTo(Task_history::class);

    }



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


    public static function getStateForWorkshop($id, $state, $inprogress = false) {

        if(!$inprogress) {

            $states = array(

                "notfinished" => Assignment::where('state', $state)->where('workshop_id', $id)->whereNull('done_by_user_id')->get()->count(),
                "finished" => Assignment::where('state', $state)->where('workshop_id', $id)->get()->count()

            );

        } else {

            // If request is for state "In Progress" call this function

            $states = array(

                "notfinished" => Assignment::where('state', 3)->where('workshop_id', $id)->whereNull('done_by_user_id')->orWhere('state', 4)->where('workshop_id', $id)->whereNull('done_by_user_id')->orWhere('state', 5)->where('workshop_id', $id)->whereNull('done_by_user_id')->get()->count(),
                "finished" => Assignment::where('state', 3)->where('workshop_id', $id)->orWhere('state', 4)->where('workshop_id', $id)->orWhere('state', 5)->where('workshop_id', $id)->get()->count()

            );

        }

        return $states;

    }

    public static function getFilteredAssignments($request) {

        //Filtersequence: name -> state -> priority -> workshop -> pctype -> systemlanguage

        $query = Assignment::query();

        $query->select('assignments.*');

        $query->when($request->has('search'), function ($query) use ($request) {

            $query->where('assignments.name', 'like', '%'.$request->input('search').'%');

        });

        $query->when($request->filled('state'), function ($query) use ($request) {

            $query->where('assignments.state', $request->input('state'));

        });

        $query->when($request->filled('priority'), function ($query) use ($request) {

            $query->where('assignments.priority', $request->input('priority'));

        });

        $query->when($request->filled('workshop'), function ($query) use ($request) {

            $query->join('workshops', 'assignments.workshop_id', '=', 'workshops.id')->where('workshops.id', $request->input('workshop'));

        });

        $query->when($request->filled('pctype'), function ($query) use ($request) {

            $query->join('pcs', 'assignments.repair_object_id', '=', 'pcs.repair_object_id')->where('pcs.pc_type', $request->input('pctype'));

        });

        $query->when($request->filled('systemlanguage'), function ($query) use ($request) {

            if($request->filled('pctype')) {

                $query->where('pcs.system_language', $request->input('systemlanguage'));

            } else {

                $query->join('pcs', 'assignments.repair_object_id', '=', 'pcs.repair_object_id')->where('pcs.system_language', $request->input('systemlanguage'));

            }

        });

        return $query->orderBy('created_at', 'desc')->get();

    }

}

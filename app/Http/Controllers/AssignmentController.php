<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Assignment_history;
use App\Models\Note;
use App\Models\Notes_assignment;
use App\Models\Notes_repair_object;
use App\Models\Pc;
use App\Models\Repair_object;
use App\Models\Workshop;
use App\Models\Default_task;
use App\Models\Device_default_task;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        //Get all assignments from DB

        $request->validate([
            'filter' => 'numeric',
        ]);

        $assignments = array();
        $workshops = Workshop::all()->keyBy('id');
        $states = Assignment::getStates();
        $priorities = Assignment::getPriorities();
        $pctypes = Pc::getPctypes();
        $systemlanguages = Pc::getSystemlanguages();
        $filter = array('state' => null, 'search' => null, 'workshop' => null, 'priority' => null, 'pctype' => null, 'systemlanguage' => null, 'assignmentfilter' => null);

        //Write field values into $filter
        foreach($filter as $key => $f) {

            if(isset($request->{$key})) {

                $filter[$key] = $request->{$key};

            }

        }

        //Filter assignments
        if (isset($request->assignmentfilter)) {

            $assignments = Assignment::getFilteredAssignments($request);

        } else {

            //If there is only a search value and no filter

            $assignments = Assignment::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->get();
            $filter['search'] = $request->search;

        }

        foreach ($assignments as $assignment) {

            $assignment['repair_object'] = Repair_object::getName($assignment->repair_object_id);
            $assignment['workshop'] = Workshop::getName($assignment->workshop_id);
            $assignment['state_name'] = trans('home.assignmentprogress.' . Assignment::getStates()[$assignment->state]);
            $assignment['priority_name'] = trans('assignment.priority.' . Assignment::getPriorities()[$assignment->priority]);
            $assignment['pc_type'] = trans('admin.devicetype.' . Pc::getPctype($assignment->repair_object_id));
            $assignment['system_language'] = trans('assignment.' . Pc::getSystemLanguageWithId($assignment->repair_object_id));
            $assignment['tasks'] = array(

                'finished'  => Task::countTasks($assignment->repair_object_id),
                'notfinished' => Task::countFinishedtasks($assignment->repair_object_id),

            );

        }

        foreach ($states as $index => $state) {

            $states[$index] = trans('home.assignmentprogress.' . $state);

        }

        foreach ($priorities as $index => $priority) {

            $priorities[$index] = trans('assignment.priority.' . $priority);

        }

        foreach ($pctypes as $index => $pctype) {

            $pctypes[$index] = trans('admin.devicetype.' . $pctype);

        }

        foreach ($systemlanguages as $index => $systemlanguage) {

            $systemlanguages[$index] = trans('assignment.' . $systemlanguage);

        }

        $langs = parent::cutLocation($this->langs);

        //Return all assignments

        return view('assignment.index', compact('assignments', 'langs', 'workshops', 'filter', 'states', 'priorities', 'pctypes', 'systemlanguages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        $langs = parent::cutLocation($this->langs);

        $priorities = Assignment::getPriorities();
        $systemlanguages = Pc::getSystemlanguages();
        $pctypes = Pc::getPctypes();
        $states = Assignment::getStates();
        $workshops = Workshop::all();
        $defaulttasks = Default_Task::all();

        foreach ($systemlanguages as $index => $systemlanguage) {

            $systemlanguages[$index] = trans('assignment.' . $systemlanguage);

        }

        foreach ($pctypes as $index => $pctype) {

            $pctypes[$index] = trans('admin.devicetype.' . $pctype);

        }

        foreach ($priorities as $index => $priority) {

            $priorities[$index] = trans('assignment.priority.' . $priority);

        }

        foreach ($states as $index => $state) {

            $states[$index] = trans('home.assignmentprogress.' . $state);

        }

        return view('assignment.create', compact('langs', 'workshops', 'priorities', 'systemlanguages', 'pctypes', 'states', 'defaulttasks'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        //Check if inputs are correct/valid

        $request->validate([

            'name' => 'required|max:255',
            'systemLanguage' => 'required|numeric|between:1,3',
            'workshop' => 'required|numeric',
            'brand' => 'required|max:255',
            'cpu' => 'required|max:255',
            'ram' => 'required|numeric',
            'storage' => 'required|numeric',
            'architecture' => 'required',
            'biosKey' => 'required|max:255',
            'pcType' => 'required|numeric|between:1,2',
            'priority' => 'required|numeric|between:1,3',
            'state' => 'required|numeric|between:1,9',
            'notes' => 'nullable|max:255',
            'tasks' => 'array|nullable'

        ]);

        //Create object of input

        $repair_object = Repair_object::create([
            'name' => $request->name,
        ]);

        $pc = Pc::create([
            'brand' => $request->brand,
            'cpu' => $request->cpu,
            'ram' => $request->ram,
            'storage' => $request->storage,
            'architecture' => $request->architecture,
            'bios_key' => $request->biosKey,
            'pc_type' => $request->pcType,
            'system_language' => $request->systemLanguage,
            'repair_object_id' => $repair_object->id
        ]);

        $assignment = Assignment::create([
            'name' => $request->name,
            'priority' => $request->priority,
            'state' => $request->state,
            'workshop_id' => $request->workshop,
            'created_by_user_id' => Auth::user()->id,
            'done_by_user_id' => NULL,
            'repair_object_id' => $repair_object->id
        ]);

        $note = Note::create([
            'user_id' => Auth::user()->id,
            'text' => $request->notes
        ]);

        $note_assignment = notes_assignment::create([
            'assignment_id' => $assignment->id,
            'note_id' => $note->id
        ]);

        $note_repair_object = notes_repair_object::create([
            'repair_object_id' => $repair_object->id,
            'note_id' => $note->id
        ]);

        //Create relation to default_tasks
        if(isset($request->defaulttasks)){

            foreach($request->defaulttasks as $defaulttask) {

                $device_default_task = device_default_task::create([
                    'repair_object_id' => $repair_object->id,
                    'default_task_id' => $defaulttask,
                    'finished' => 0
                ]);

            }

        }

        //Create tasks
        if(isset($request->tasks)){

            foreach ($request->tasks as $t) {

                $task = Task::create([

                    'text' => $t,
                    'finished' => 0,
                    'repair_object_id' => $repair_object->id

                ]);

            }

        }

        //redirect to assignment.index

        return redirect()->route('assignment.show', $assignment);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment) {

        $langs = parent::cutLocation($this->langs);
        $pc = PC::getPCbyRepair_object_id($assignment->repair_object_id);

        $priority = trans('assignment.priority.' . $assignment->getPriority());
        $state = trans('home.assignmentprogress.' . $assignment->getState());
        $pctype = trans('admin.devicetype.' . $pc->getownPctype());
        $systemlanguage = trans('assignment.' . $pc->getSystemlanguage());
        $note = Note::getNoteforAssignment($assignment->id);
        $histories = Assignment_history::where('assignment_id', $assignment->id)->get();    //$histories = Assignment_history::find($assignment);
        $tasks = $assignment->repair_object->tasks;

        //Get device_default_tasks of assignment
        $device_default_tasks = $assignment->repair_object->device_default_tasks;

        $assignmentHistories = array();
        // dd($histories);
        if(!empty($histories)) {
            $lastAssignment = "";

            foreach ($histories as $key => $history) {


                    $historical_assignment = Assignment_history::where('assignment_id', $assignment->id)->where('id', '>', $history->id)->orderBy('id', 'ASC')->first();

                    if(!$historical_assignment) {
                        $historical_assignment = $assignment;
                    }

                    $lastAssignment = $history;

                    // dd($historical_assignment->toArray());
                    $tempHistory = array_diff_assoc($history->toArray(), $historical_assignment->toArray());


                //     // $historical_assignment = Assignment_history::where('assignment_id', $assignment->id)->where('id', '<', $history->id)->orderBy('id', 'DESC')->first();

                //     // if(!$historical_assignment) {
                //     //     $historical_assignment = $assignment;
                //     // }

                //     $tempHistory = array_diff_assoc($history->toArray(), $lastAssignment->toArray());


                //     $lastAssignment = $history;

                // }


                $tempHistory['object'] = $historical_assignment;
                $tempHistory['history'] = $history;
                array_unshift($assignmentHistories, $tempHistory);




            }

            // dd($assignmentHistories);

        }

        // $previousValue = null;
        // foreach ($histories as $key => $history) {

        //     $tempHistoryAssignment = Assignment_history::where('id', '<', $history->id)->where('assignment_id', $assignment->id)->orderBy('id', 'desc')->first();
        //     if(empty($tempHistoryAssignment)) {
        //         $tempHistoryAssignment = Assignment_history::where('id', '>', $history->id)->where('assignment_id', $assignment->id)->orderBy('id', 'asc')->first();
        //         $tempHistory = array_diff_assoc($tempHistoryAssignment->toArray(), $history->toArray());
        //     } else {

        //         $tempHistory = array_diff_assoc($history->toArray(), $tempHistoryAssignment->toArray());
        //     }

        //     $tempHistory['object'] = $tempHistoryAssignment;
        //     $tempHistory['history'] = $history;
        //     // dd($tempHistory);
        //     array_unshift($OldHistories, $tempHistory);
        // }
        // dd($OldHistories);

        return view('assignment.show', compact('assignment', 'langs', 'priority', 'state', 'systemlanguage', 'pctype', 'pc', 'note', 'histories', 'device_default_tasks', 'tasks', 'assignmentHistories'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment) {

        $langs = parent::cutLocation($this->langs);

        $priorities = Assignment::getPriorities();
        $systemlanguages = Pc::getSystemlanguages();
        $pctypes = Pc::getPctypes();
        $states = Assignment::getStates();
        $workshops = Workshop::all();
        $defaulttasks = Default_Task::all();
        $pc = PC::getPCbyRepair_object_id($assignment->repair_object_id);
        $tasks = $assignment->repair_object->tasks;
        $note = Note::getNoteforAssignment($assignment->id);

        foreach ($systemlanguages as $index => $systemlanguage) {

            $systemlanguages[$index] = trans('assignment.' . $systemlanguage);

        }

        foreach ($pctypes as $index => $pctype) {

            $pctypes[$index] = trans('admin.devicetype.' . $pctype);

        }

        foreach ($priorities as $index => $priority) {

            $priorities[$index] = trans('assignment.priority.' . $priority);

        }

        foreach ($states as $index => $state) {

            $states[$index] = trans('home.assignmentprogress.' . $state);

        }

        return view('assignment.edit', compact('assignment', 'langs', 'workshops', 'priorities', 'systemlanguages', 'pctypes', 'states', 'defaulttasks', 'pc', 'tasks', 'note'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment) {

        $request->validate([

            'name' => 'required|max:255',
            'priority' => 'required',
            'state' => 'required',
            'workshop_id' => 'required',
            'brand' => 'required|max:255',
            'cpu' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'architecture' => 'required',
            'bios_key' => 'required',
            'pc_type' => 'required',
            'system_language' => 'required',
            'notes' => 'max:255'

        ]);

        // Update assignment information

        $assignment->update([

            'name' => $request->input('name'),
            'priority' => $request->input('priority'),
            'state' => $request->input('state'),
            'workshop_id' => $request->input('workshop_id'),
            'done_by_user_id' => $request->input('done_by_user_id')

        ]);

        // Update pc information

        $pc = Pc::getPCbyRepair_object_id($request->input('repair_object_id'));
        $pc->update([

            'brand' => $request->input('brand'),
            'cpu' => $request->input('cpu'),
            'ram' => $request->input('ram'),
            'storage' => $request->input('storage'),
            'architecture' => $request->input('architecture'),
            'bios_key' => $request->input('bios_key'),
            'pc_type' => $request->input('pc_type'),
            'system_language' => $request->input('system_language')

        ]);

        // Update note

        $note = Note::getNoteforAssignment($assignment->id);
        $note->update([

            'text' => $request->input('notes')

        ]);

        // Create tasks

        if(isset($request->createtasks)) {

            foreach ($request->createtasks as $t) {

                $task = Task::create([

                    'text' => $t,
                    'finished' => 0,
                    'repair_object_id' => $request->input('repair_object_id')

                ]);

            }

        }

        // Delete tasks

        if(isset($request->deletetasks)) {

            foreach($request->deletetasks as $deletetask) {

                $task = Task::find($deletetask);
                $task->delete();

            }

        }

        // Update tasks

        $tasks = Task::getTasksbyassignment($assignment->id);
        foreach($tasks as $task) {

            $task->update([

                'text' => $request->updatetasks[$task->id]

            ]);

        }

        if($assignment->wasChanged()) {

            $history = Assignment_history::where('assignment_id', $assignment->id)->latest('historical_timestamp')->first();
            $history->done_by_user_id = Auth::user()->id;
            $history->timestamps = false;
            $history->save();

        }

        return redirect()->route('assignment.show', $assignment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment) {

        //Delete assignment

        $assignment->delete();

        //Redirect to assignment.index

        return redirect()->route('assignment.index');

    }

    public function changeDone(Request $request) {

        // Update Default Tasks
        if(isset($request->default_tasks)) {

            foreach ($request->default_tasks as $id => $status) {

                if($id != 0) {

                    $device_default_task = Device_default_task::findByRepair_objectDefault_task($request->repair_object_id, $id);

                    switch ($status) {

                        case 'check':
                            $device_default_task->finished = 1;
                            $device_default_task->save();
                            // $task->done_by_user_id = Auth::user()->id;    -> Save done_by_user into default_task_histories after save
                            break;

                        case 'uncheck':
                            $device_default_task->finished = 0;
                            $device_default_task->save();
                            // $task->done_by_user_id = NULL;    -> Save done_by_user into default_task_histories after save
                            break;

                    }

                }

            }

        }

        // Update Additional Tasks
        if(isset($request->tasks)) {

            foreach ($request->tasks as $task => $status) {

                $task = Task::find($task);

                switch ($status) {

                    case 'check':
                        $task->finished = 1;
                        $task->done_by_user_id = Auth::user()->id;
                        break;

                    case 'uncheck':
                        $task->finished = 0;
                        $task->done_by_user_id = NULL;
                        break;

                }

                $task->save();

            }

        }

        return redirect()->back();

    }

}

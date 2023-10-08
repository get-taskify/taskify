<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Task;
use App\Models\Task_history;
use Illuminate\Http\Request;

class TaskController extends Controller {

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
    public function index() {

        //Get all tasks from DB

        $tasks = Task::all();

        //Return all tasks

        $langs = parent::cutLocation($this->langs);

        return view('task.index', compact('tasks', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('task.create');
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

            'text' => 'required|max:255',
            'finished' => 'required',
            'repair_object_id' => 'required',
            'done_by_user_id' => 'required'

        ]);

        //Create object of input

        Task::create([

            'text' => $request->input('text'),
            'finished' => $request->input('finished'),
            'repair_object_id' => $request->input('repair_object_id'),
            'done_by_user_id' => $request->input('done_by_user_id')

        ]);

        //redirect to task.index

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task) {

        //Get assignment with id

        //Return specific tasks


        $langs = $this->langs;
        return view('task.show', compact('task', 'langs'));

    }

    public function assignment(Assignment $assignment) {

        $langs = $this->langs;

        $tasks = $assignment->repair_object->tasks;

        return view('task.assignment', compact('tasks', 'assignment', 'langs'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task) {

        //Show edit form

        return view('task.edit', compact('task'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task) {

        $request->validate([

            'text' => 'required|max:255',
            'finished' => 'required',
            'repair_object_id' => 'required',
            'done_by_user_id' => 'required'

        ]);

        $task->update([

            'text' => $request->input('text'),
            'finished' => $request->input('finished'),
            'repair_object_id' => $request->input('repair_object_id'),
            'done_by_user_id' => $request->input('done_by_user_id')

        ]);

        return redirect()->route('task.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) {

        //Delete task

        $task->delete();

        //Redirect to task.index

        return redirect()->route('task.index');

    }





    public function history() {

        $langs = $this->langs;

        $tasks = Task_history::all();


        return view('task.history', compact('langs', 'tasks'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Default_task;
use Illuminate\Http\Request;

class DefaultTaskController extends Controller {

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

        //Get all default_tasks from DB

        $default_tasks = Default_task::all();

        //Return all default_tasks

        $langs = parent::cutLocation($this->langs);

        return view('default_task.index', compact('default_tasks', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        $langs = parent::cutLocation($this->langs);

        return view('default_task.create', compact('langs'));

        return view('users');

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

            'device_type' => 'required',
            'text' => 'required'

        ]);

        //Create object of input

        Default_task::create([

            'device_type' => $request->input('device_type'),
            'text' => $request->input('text')

        ]);

        //redirect to default_task.index

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Default_task  $default_task
     * @return \Illuminate\Http\Response
     */
    public function show(Default_task $default_task) {

        //Get default_task with id

        $default_task = Default_task::find($default_task->id);

        //Return specific default_task

        return view('default_task.show', compact('default_task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Default_task  $default_task
     * @return \Illuminate\Http\Response
     */
    public function edit(Default_task $default_task) {

        //Show edit form
        $langs = parent::cutLocation($this->langs);

        $langs = parent::cutLocation($this->langs);

        return view('default_task.edit', compact('default_task', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Default_task  $default_task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Default_task $default_task) {

        $request->validate([

            'device_type' => 'required',
            'text' => 'required'

        ]);

        $default_task->update([

            'device_type' => $request->input('device_type'),
            'text' => $request->input('text'),

        ]);

        return redirect()->route('users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Default_task  $Default_task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Default_task $Default_task) {

        //Delete Default_task

        $Default_task->delete();

        //Redirect to Default_task.index

        return redirect()->route('users');

    }

}

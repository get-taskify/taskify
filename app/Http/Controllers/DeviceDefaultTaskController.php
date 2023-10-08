<?php

namespace App\Http\Controllers;

use App\Models\Device_default_task;
use Illuminate\Http\Request;

class DeviceDefaultTaskController extends Controller {

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

        //Get all device_default_tasks from DB

        $device_default_tasks = Device_default_task::all();

        //Return all device_default_tasks

        $langs = parent::cutLocation($this->langs);

        return view('device_default_task.index', compact('device_default_tasks', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form
        $langs = parent::cutLocation($this->langs);

        return view('device_default_task.create', compact('langs'));
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

            'finished' => 'required',
            'repair_object_id' => 'required',
            'default_task_id' => 'required'

        ]);

        //Create object of input

        Device_default_task::create([

            'finished' => $request->input('finished'),
            'repair_object_id' => $request->input('repair_object_id'),
            'default_task_id' => $request->input('default_task_id')

        ]);

        //redirect to device_default_task.index

        return redirect()->route('device_default_task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device_default_task  $device_default_task
     * @return \Illuminate\Http\Response
     */
    public function show(Device_default_task $device_default_task) {

        //Get device_default_task with id

        $device_default_task = Device_default_task::find($device_default_task->id);

        //Return specific device_default_task

        return view('device_default_task.show', compact('device_default_task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device_default_task  $device_default_task
     * @return \Illuminate\Http\Response
     */
    public function edit(Device_default_task $device_default_task) {

        //Show edit form

        return view('device_default_task.edit', compact('device_default_task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device_default_task  $device_default_task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device_default_task $device_default_task) {

        $request->validate([

            'finished' => 'required',
            'repair_object_id' => 'required',
            'default_task_id' => 'required'

        ]);

        $device_default_task->update([

            'finished' => $request->input('finished'),
            'repair_object_id' => $request->input('repair_object_id'),
            'default_task_id' => $request->input('default_task_id')

        ]);

        return redirect()->route('device_default_task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device_default_task  $device_default_task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device_default_task $device_default_task) {

        //Delete device_default_task

        $device_default_task->delete();

        //Redirect to device_default_task.index

        return redirect()->route('device_default_task.index');
    }
}

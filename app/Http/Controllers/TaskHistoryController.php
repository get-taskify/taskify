<?php

namespace App\Http\Controllers;

use App\Models\Task_history;
use Illuminate\Http\Request;

class TaskHistoryController extends Controller {

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
    public function index(){

        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task_history  $task_history
     * @return \Illuminate\Http\Response
     */
    public function show(Task_history $task_history) {

        //Get task_history with id

        $task_history = Task_history::find($task_history->id);

        //Return specific task_history

        return view('task_history.show', compact('task_history'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task_history  $task_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Task_history $task_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task_history  $task_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task_history $task_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task_history  $task_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task_history $task_history) {

        //Delete task_history

        $task_history->delete();

        //Redirect to task_history.index

        return redirect()->route('task_history.index');

    }

}

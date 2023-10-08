<?php

namespace App\Http\Controllers;

use App\Models\Default_task_history;
use Illuminate\Http\Request;

class DefaultTaskHistoryController extends Controller {

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
    public function index()
    {
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
     * @param  \App\Models\Default_task_history  $default_task_history
     * @return \Illuminate\Http\Response
     */
    public function show(Default_task_history $default_task_history) {

        //Get default_task_history with id

        $default_task_history = Default_task_history::find($default_task_history->id);

        //Return specific default_task_history

        return view('default_task_history.show', compact('default_task_history'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Default_task_history  $default_task_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Default_task_history $default_task_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Default_task_history  $default_task_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Default_task_history $default_task_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Default_task_history  $default_task_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Default_task_history $default_task_history) {

        //Delete default_task_history

        $default_task_history->delete();

        //Redirect to default_task_history.index

        return redirect()->route('default_task_history.index');

    }

}

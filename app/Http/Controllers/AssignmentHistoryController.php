<?php

namespace App\Http\Controllers;

use App\Models\Assignment_history;
use Illuminate\Http\Request;

class AssignmentHistoryController extends Controller {

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
     * @param  \App\Models\Assignment_history  $assignment_history
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment_history $assignment_history) {

        //Get assignment_history with id

        $assignment_history = Assignment_history::find($assignment_history->id);

        //Return specific assignment_history

        return view('assignment_history.show', compact('assignment_history'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment_history  $assignment_history
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment_history $assignment_history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment_history  $assignment_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment_history $assignment_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment_history  $assignment_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment_history $assignment_history) {

        //Delete assignment_history

        $assignment_history->delete();

        //Redirect to assignment_history.index

        return redirect()->route('assignment_history.index');

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Assignment;
use Illuminate\Http\Request;

class WorkshopController extends Controller {

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

        //Get all workshops from DB

        $workshops = Workshop::all();
        $states = array('Not Assigned', 'Waiting', 'In Progress', 'Paused', 'Ready', 'Cancelled', 'Done');

        foreach ($workshops as $workshop) {

            $state = array();

            $state[] = Assignment::getStateForWorkshop($workshop->id, 1); //Not Assigned
            $state[] = Assignment::getStateForWorkshop($workshop->id, 2); //Waiting
            $state[] = Assignment::getStateForWorkshop($workshop->id, 0, true); //In Progress
            $state[] = Assignment::getStateForWorkshop($workshop->id, 6); //Paused
            $state[] = Assignment::getStateForWorkshop($workshop->id, 7); //Ready
            $state[] = Assignment::getStateForWorkshop($workshop->id, 9); //Cancelled
            $state[] = Assignment::getStateForWorkshop($workshop->id, 8); //Done

            $workshop['state'] = $state;

        }

        $langs = parent::cutLocation($this->langs);

        //Return all workshops

        return view('workshop.index', compact('workshops', 'langs', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        $langs = parent::cutLocation($this->langs);

        return view('workshop.create', compact('langs'));
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
            'address' => 'required|max:255'

        ]);

        //Create object of input

        workshop::create([

            'name' => $request->input('name'),
            'address' => $request->input('address')

        ]);

        //redirect to workshop.index

        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop) {

        //Return specific workshop

        return view('workshop.show', compact('workshop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop) {

        $langs = parent::cutLocation($this->langs);

        return view('workshop.edit', compact('workshop', 'langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop) {

        $request->validate([

            'name' => 'required|max:255',
            'address' => 'required|max:255'

        ]);

        $workshop->update([

            'name' => $request->input('name'),
            'address' => $request->input('address')

        ]);

        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop) {

        //Delete workshop

        $workshop->delete();

        //Redirect to workshop.index

        return redirect()->route('users');
    }
}

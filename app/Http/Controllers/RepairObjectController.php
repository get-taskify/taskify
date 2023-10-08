<?php

namespace App\Http\Controllers;

use App\Models\Repair_object;
use Illuminate\Http\Request;

class RepairObjectController extends Controller {

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

        //Get all repair_objects from DB

        $repair_objects = Repair_object::all();

        //Return all repair_objects

        $langs = parent::cutLocation($this->langs);

        return view('repair_object.index', compact('repair_objects', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('repair_object.create');
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

            'name' => 'required|max:255'

        ]);

        //Create object of input

        Repair_object::create([

            'name' => $request->input('name')

        ]);

        //redirect to repair_object.index

        return redirect()->route('repair_object.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair_object  $repair_object
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {

        //Get repair_object with id

        $repair_object = Repair_object::find($request->id)->first();

        //Return specific repair_object
        $langs = parent::cutLocation($this->langs);

        return view('repair_object.show', compact('repair_object', 'langs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair_object  $repair_object
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair_object $repair_object) {

        //Show edit form

        return view('repair_object.edit', compact('repair_object'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair_object  $repair_object
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair_object $repair_object) {

        $request->validate([

            'name' => 'required|max:255'

        ]);

        $repair_object->update([

            'name' => $request->input('name')

        ]);

        return redirect()->route('repair_object.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repair_object  $repair_object
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair_object $repair_object) {

        //Delete repair_object

        $repair_object->delete();

        //Redirect to repair_object.index

        return redirect()->route('repair_object.index');
    }
}

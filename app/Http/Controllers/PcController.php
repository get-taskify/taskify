<?php

namespace App\Http\Controllers;

use App\Models\Pc;
use Illuminate\Http\Request;

class PcController extends Controller {

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

        //Get all pcs from DB

        $pcs = Pc::all();

        //Return all pcs

        $langs = parent::cutLocation($this->langs);

        return view('pc.index', compact('pcs', 'langs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('pc.create');

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

            'repair_object_id' => 'required',
            'brand' => 'required|max:255',
            'cpu' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'architecture' => 'required',
            'bios_key' => 'required',
            'pc_type' => 'required',
            'system_language' => 'required'

        ]);

        //Create object of input

        Pc::create([

            'repair_object_id' => $request->input('repair_object_id'),
            'brand' => $request->input('brand'),
            'cpu' => $request->input('cpu'),
            'ram' => $request->input('ram'),
            'storage' => $request->input('storage'),
            'architecture' => $request->input('architecture'),
            'bios_key' => $request->input('bios_key'),
            'pc_type' => $request->input('pc_type'),
            'system_language' => $request->input('system_language')

        ]);

        //redirect to pc.index

        return redirect()->route('pc.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function show(Pc $pc) {

        //Get pc with id

        $pc = Pc::find($pc->id);

        //Return specific pc

        return view('pc.show', compact('pc'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function edit(Pc $pc) {

        //Show edit form

        return view('pc.edit', compact('pc'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pc $pc) {

        $request->validate([

            'repair_object_id' => 'required',
            'brand' => 'required|max:255',
            'cpu' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'architecture' => 'required',
            'bios_key' => 'required',
            'pc_type' => 'required',
            'system_language' => 'required'

        ]);

        $pc->update([

            'repair_object_id' => $request->input('repair_object_id'),
            'brand' => $request->input('brand'),
            'cpu' => $request->input('cpu'),
            'ram' => $request->input('ram'),
            'storage' => $request->input('storage'),
            'architecture' => $request->input('architecture'),
            'bios_key' => $request->input('bios_key'),
            'pc_type' => $request->input('pc_type'),
            'system_language' => $request->input('system_language')

        ]);

        return redirect()->route('pc.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pc  $pc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pc $pc) {

        //Delete pc

        $pc->delete();

        //Redirect to pc.index

        return redirect()->route('pc.index');

    }

}

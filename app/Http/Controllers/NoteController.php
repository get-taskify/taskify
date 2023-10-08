<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller {

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

        //Get all notes from DB

        $notes = Note::all();

        //Return all notes

        $langs = parent::cutLocation($this->langs);

        return view('note.index', compact('notes', 'langs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('note.create');

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
            'user_id' => 'required'

        ]);

        //Create object of input

        Note::create([

            'text' => $request->input('text'),
            'user_id' => $request->input('user_id')

        ]);

        //redirect to note.index

        return redirect()->route('note.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note) {

        //Get note with id

        $note = Note::find($note->id);

        //Return specific note

        return view('note.show', compact('note'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note) {

        //Show edit form

        return view('note.edit', compact('note'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note) {

        $request->validate([

            'text' => 'required|max:255',
            'user_id' => 'required'

        ]);

        $note->update([

            'text' => $request->input('text'),
            'user_id' => $request->input('user_id')

        ]);

        return redirect()->route('note.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note) {

        //Delete note

        $note->delete();

        //Redirect to note.index

        return redirect()->route('note.index');

    }

}

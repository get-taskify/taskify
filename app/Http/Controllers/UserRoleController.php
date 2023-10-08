<?php

namespace App\Http\Controllers;

use App\Models\User_role;
use Illuminate\Http\Request;

class UserRoleController extends Controller {

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

        //Get all user_roles from DB

        $user_roles = User_role::all();

        //Return all user_roles

        $langs = parent::cutLocation($this->langs);

        return view('user_role.index', compact('user_roles', 'langs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        //Show create form

        return view('user_role.create');
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

            'role' => 'required',
            'user_id' => 'required'

        ]);

        //Create object of input

        User_role::create([

            'role' => $request->input('role'),
            'user_id' => $request->input('user_id')

        ]);

        //redirect to user_role.index

        return redirect()->route('user_role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function show(User_role $user_role) {

        //Get user_role with id

        $user_role = User_role::find($user_role->id);

        //Return specific user_role

        return view('user_role.show', compact('user_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function edit(User_role $user_role) {

        //Show edit form

        return view('user_role.edit', compact('user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_role $user_role) {

        $request->validate([

            'role' => 'required',
            'user_id' => 'required'

        ]);

        $user_role->update([

            'role' => $request->input('role'),
            'user_id' => $request->input('user_id')

        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_role $user_role) {

        //Delete user_role

        $user_role->delete();

        //Redirect to user_role.index

        return redirect()->route('user_role.index');
    }
}

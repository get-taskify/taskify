<?php

namespace App\Http\Controllers;

use App\Models\Default_task;
use App\Models\User;
use App\Models\User_role;
use App\Models\Workshop;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Validation\Rules\Password;
use Session;
use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

class UsersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->middleware('auth');

    }

    public function index() {

        $users = User::all();
        $roles = User::getRoles();
        $langs = parent::cutLocation($this->langs);
        $usercounter = 0;
        $defaulttasks = Default_task::all();
        $devicetypes = Default_task::getDevice_types();
        $workshops = Workshop::all();

        foreach ($users as $user) {

            $user['user_roles'] = User_role::where('user_id', $user->id)->pluck('role')->toArray();
            $user['role_ids'] = $user->getRoleIds();

        }

        foreach ($roles as $index=>$role) {

            $roles[$index] = trans('home.team.'.$role);

        }

        foreach ($devicetypes as $index=>$devicetype) {

            $devicetypes[$index] = trans('admin.devicetype.'.$devicetype);

        }

        return view('users.index', compact('users', 'roles', 'langs', 'usercounter', 'defaulttasks', 'devicetypes', 'workshops'));

    }

    public function store(Request $request) {

        //Check if inputs are correct/valid

        $request->validate([

            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'array'

        ]);

        //Create object of input

        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        if ($request->roles) {

            foreach ($request->roles as $role) {

                $update = User_role::create([

                    'role' => $role,
                    'user_id' => $user->id

                ]);

                if ($update) {

                    Session::flash('message', __('Update successful!'));
                    Session::flash('alert-class', 'alert-success');

                } else {

                    Session::flash('message', 'Error during update!');
                    Session::flash('alert-class', 'alert-danger');

                }

            }

        }

        return redirect()->back();

    }

    public function edit() {

        $langs = parent::cutLocation($this->langs);

        $user = Auth::user();
        $user['role_ids'] = $user->getRoleIds();

        return view('users.edit', compact('user', 'langs'));

    }

    public function update(Request $request) {

        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'newPassword'
        ]);


        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->newPassword)
        ]);

        if ($update) {

            Session::flash('message', 'Profile Update Successfully!');
            Session::flash('alert-class', 'alert-success');

        } else {

            Session::flash('message', 'Error during Update!');
            Session::flash('alert-class', 'alert-danger');

        }

        return redirect()->back();

    }

    public function updatePassword(Request $request) {

        $user = auth()->user();

        //Validate
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => [
                'required',
                Password::min(8),
            ],
            'newPassword2' => 'required|same:newPassword'
        ]);

        if (!Hash::check($request->currentPassword, $user->password)) { //Check if Input matches Password of DB

            Session::flash('message', 'Wrong Current Password!');
            Session::flash('alert-class', 'alert-danger');

        }

        $update = $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        if ($update) {

            Session::flash('message', 'Profile Password Successfully!');
            Session::flash('alert-class', 'alert-success');

        } else {

            Session::flash('message', 'Error during Password Update !');
            Session::flash('alert-class', 'alert-danger');

        }


        Auth::logout();
        return redirect()->back();

    }

    public function updateRole(Request $request) {

        $request->validate([
            'user_id' => 'required|integer',
            'roles' => 'array',
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|email|string|max:255',
            'newPassword' => [
                'nullable',
                Password::min(8),
            ],

        ]);

        //Reset all User Roles
        User_role::where('user_id', $request->user_id)->delete();

        //Change User settings
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->newPassword) {

            $user->password = Hash::make($request->newPassword);

        }

        if ($user->save()) {

            Session::flash('message', __('User update successful!'));
            Session::flash('alert-class', 'alert-success');

        } else {

            Session::flash('message', 'Error  user during update!');
            Session::flash('alert-class', 'alert-danger');

        }

        if ($request->roles) {

            foreach ($request->roles as $role) {

                $update = User_role::create([
                    'role' => $role,
                    'user_id' => $request->user_id
                ]);



                if ($update) {

                    Session::flash('message', __('Update successful!'));
                    Session::flash('alert-class', 'alert-success');

                } else {

                    Session::flash('message', 'Error during update!');
                    Session::flash('alert-class', 'alert-danger');

                }

            }

        }

        return redirect()->back();

    }

    public function destroy(User $user) {

        //Delete User

        $user->delete();

        return redirect()->back();

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\News;
use App\Models\User;
use App\Models\User_role;

use Illuminate\Http\Request;

class HomeController extends Controller {

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $news = News::orderBy('created_at', 'DESC')->get();
        $users = User::all();
        $teamcounter = 0;

        foreach ($users as $user) {

            $user['role_ids'] = $user->getRoleIds();

        }

        $state = array();

        $state['notAssigned'] = Assignment::where('state', 1)->whereNull('done_by_user_id')->get()->count();
        $state['waiting'] = Assignment::where('state', 2)->whereNull('done_by_user_id')->get()->count();
        $state['done'] = Assignment::where('state', 6)->whereNull('done_by_user_id')->get()->count();
        $state['paused'] = Assignment::where('state', 4)->whereNull('done_by_user_id')->get()->count();
        $state['ready'] = Assignment::where('state', 5)->whereNull('done_by_user_id')->get()->count();
        $state['cancelled'] = Assignment::where('state', 7)->whereNull('done_by_user_id')->get()->count();
        $state['inProgress'] = Assignment::where('state', 3)->whereNull('done_by_user_id')->get()->count();

        $langs = parent::cutLocation($this->langs);

        return view('index', compact('news', 'users', 'teamcounter', 'state', 'langs'));
    }
}

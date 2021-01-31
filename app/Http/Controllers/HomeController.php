<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Organisation;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $dashboard = [];

        if ($user->access_level === 1) {
            $dashboard['organisations'] = Organisation::all();
        } else if ($user->access_level === 2){
            $dashboard['teachers'] = User::getAllTeachers($user->organisation_id);
        } else if ($user->access_level === 3){
            $dashboard['classgroups'] = ClassGroup::getAllClassGroups($user->id);
        } else if ($user->access_level === 4){
            $dashboard['tasks'] = Task::getAllTasksForStudent($user->id);
        }  // TODO: setup logic for parents when logged in
        else if ($user->access_level === 5 && 1==2){
            $dashboard['teachers'] = 3; // TODO: get students belonging to this parent
        }

        return view('dashboard', compact('user', 'dashboard'));
    }
}

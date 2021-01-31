<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = Organisation::all();
        return view('organisations', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_organisation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create([
            'title' => $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => NOW(),
            'organisation_id' => 0,
            'access_level' => 2,
        ]);

        $organisation = Organisation::create([
            'name' => $request->organisation,
            'administrator_id' => $user->id,
            'expiry_date' => date('Y-m-d', strtotime('+1 year', strtotime(NOW()))),
        ]);

        DB::table('users')
              ->where('id', $user->id)
              ->update(['organisation_id' => $organisation->id]);

        return redirect('/organisations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(Organisation $organisation)
    {
        $user = Auth::user();

        $teachers = User::withCount(['classGroup', 'tasks'])
                ->where('organisation_id', '=', $organisation->id)
                ->where('access_level', '=', 3)
                ->get();

        return view('show_organisation', compact('organisation', 'teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Organisation $organisation)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organisation $organisation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        //
    }

    /**
     * Show the form to create a new user at the access
     * level of Teacher for the current organisation.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function create_teacher()
    {
        $isAdmin = Auth::user()->access_level == 1 ? true : false;
        $organisations = Organisation::all();

        return view('create_teacher', compact('organisations', 'isAdmin'));
    }

    /**
     * Store a new Teacher level user in the database
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     * @todo Ensure that we check its the correct person submitting the form
     * @todo Ensure that we are adding them to the correct organisation
     */
    public function store_teacher(Request $request)
    {
        $organisation = $request->organisation ?: Auth::user()->organisation_id;

        User::create([
            'title' => $request->title,
            'forename' => $request->forename,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => NOW(),
            'organisation_id' => $organisation,
            'access_level' => 3,
        ]);

        return redirect('/organisations/'.$organisation);
    }

     /**
     * Show the form to create a new user at the access
     * level of Teacher for the current organisation.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function create_student(ClassGroup $classgroup)
    {
        if (Auth::user()->access_level === 1) {
            $teachers = DB::table('users')
                ->where('organisation_id', '=', $classgroup->organisation_id)
                ->where('access_level', '=', 3)
                ->get();
        } else {
            $teachers = false;
        }

        $currentClass = $classgroup;
        $classGroups = DB::table('class_groups')
                ->where('user_id', '=', $classgroup->user_id)
                ->where('id', '!=', $currentClass->id)
                ->get();

        return view('create_student', compact('currentClass', 'classGroups', 'teachers'));
    }


     /**
     * Store a new Teacher level user in the database
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     * @todo Ensure that we check its the correct person submitting the form
     * @todo Ensure that we are adding them to the correct organisation
     */
    public function store_student(Request $request)
    {
        $organisation = $request->organisation ?: Auth::user()->organisation_id;

        $student = User::create([
            'forename' => $request->forename,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => NOW(),
            'organisation_id' => $organisation,
            'access_level' => 4,
        ]);

        DB::table('students_to_classes')->insert([
            'class_id' => $request->classgroup,
            'user_id' => $student->id
        ]);

        return redirect()->back();
    }


    public function show_class(Organisation $organisation, User $user, ClassGroup $classgroup)
    {
        $tasks = DB::table('tasks')
                ->leftJoin('tasks_to_classes', 'tasks.id', '=', 'tasks_to_classes.task_id')
                ->where('tasks_to_classes.class_id', $classgroup->id)
                ->get();

        $students = DB::table('users')
            ->leftJoin('students_to_classes', 'users.id', '=', 'students_to_classes.user_id')
            ->where('students_to_classes.class_id', '=', $classgroup->id)
            ->get();

        return view('show_class', compact('organisation', 'classgroup', 'students'));
    }

}

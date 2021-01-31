<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ClassGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classGroups = ClassGroup::withCount('students_to_classes')
                ->where('user_id', '=', Auth::user()->id)
                ->get();

        return view('classgroups', compact('classGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_class');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * // TODO: allow the ability to create classes on behalf of organisations for admins and super admins
     *          add a dropdown to the form for these users to specify which organisation and teacher etc
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        DB::table('class_groups')->insert([
            'organisation_id' => $user->organisation_id,
            'user_id' => $user->id,
            'name' => $request->name,
            'year_group' => $request->year,
            'active' => 1,
            'deleted' => 0,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        return redirect('/classgroups');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ClassGroup $classgroup)
    {
        $tasks = DB::table('tasks')
                ->leftJoin('tasks_to_classes', 'tasks.id', '=', 'tasks_to_classes.task_id')
                ->where('tasks_to_classes.class_id', $classgroup->id)
                ->get();

        $students = DB::table('users')
            ->leftJoin('students_to_classes', 'users.id', '=', 'students_to_classes.user_id')
            ->where('students_to_classes.class_id', $classgroup->id)
            ->get();

        $outstandingTasks = [];
        foreach ($tasks as $task) {
            if ($task->due_date > NOW()){
                $outstandingTasks[] = $task;
            }
        }

        return view('show_class', compact('classgroup', 'students', 'tasks', 'outstandingTasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassGroup $classGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassGroup $classGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassGroup $classGroup)
    {
        //
    }
}

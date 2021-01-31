<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function classGroups()
    {
        return $this->hasMany(classGroup::class);
    }

    public function show_teacher(User $user)
    {
        $classgroups = ClassGroup::withcount('students_to_classes')
                ->where('user_id', $user->id)
                ->get();

        return view('show_teacher', compact('user', 'classgroups'));
    }

    public function show_student(User $user)
    {
        $tasks = Task::withcount('questions')
                    ->leftJoin('tasks_to_students', 'tasks.id', '=', 'tasks_to_students.task_id')
                    ->where('tasks_to_students.student_id', $user->id)
                    ->get();

        return view('show_student', compact('user', 'tasks'));
    }
}

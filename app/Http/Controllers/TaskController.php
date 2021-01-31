<?php

namespace App\Http\Controllers;

use App\Models\ClassGroup;
use App\Models\Organisation;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Models\SubUnit;
use App\Models\Unit;
use Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::withCount('questions')->get();

        foreach ($tasks as &$task){
            $topic = $task->topic;

            $subUnit = DB::table('sub_units')
                    ->where('unit_id', $topic->sub_unit_id)
                    ->get()
                    ->first();

            $unit = DB::table('units')
                    ->where('id', $subUnit->unit_id)
                    ->get()
                    ->first();

            $task->subUnit = $subUnit->name;
            $task->unit = $unit->name;
        }

        return view('tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassGroup $classgroup)
    {
        $topics = Topic::all();
        $placeholder = $topics->first();

        return view('create_task', compact('topics', 'placeholder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'topic_id' => $request->topic,
            'name' => $request->name,
            'active' => 1,
            'deleted' => 0,
        ]);

        for ($i=0; $i<count($request->input('questions')); $i++){
            DB::table('questions')->insert([
                'task_id' => $task->id,
                'question' => $request->input('questions')[$i],
                'answer' => $request->input('answers')[$i],
                'options' => $request->input('options')[$i],
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    /**
     * Show the form to set a task to a specific classgroup
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function set_task(ClassGroup $classgroup)
    {
        $tasks = Task::all();

        $dates['min'] = date('Y-m-d', strtotime("+ 1 day"));
        $dates['max'] = date('Y-m-d', strtotime("+ 1 month"));

        return view('set_task', compact('classgroup', 'tasks', 'dates'));
    }

    /**
     * Assign the task to a whole class or set of students
     *
     * @param  \App\Models\ClassGroup  $classGroup
     * @return \Illuminate\Http\Response
     */
    public function assign_task(ClassGroup $classgroup, Request $request)
    {
        $students = DB::table('users')
            ->leftJoin('students_to_classes', 'users.id', '=', 'students_to_classes.user_id')
            ->where('students_to_classes.class_id', '=', $classgroup->id)
            ->get();

        //add to tasks_to_classes
        DB::table('tasks_to_classes')->insert([
            'task_id' => $request->task,
            'class_id' => $classgroup->id,
            'whole_class' => 1,
            'number_assigned_to' => count($students),
            'number_completed' => 0,
            'due_date' => $request->due_date . " 11:59:59",
            'percent_completed' => 0,
            'average_score' => 0,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        //add to tasks_to_students
        // TODO, correct this, student_id isn't correct when getting them from the database
        foreach ($students as $student) {
            DB::table('tasks_to_students')->insert([
                'task_id' => $request->task,
                'student_id' => $student->user_id,
                'due_date' => $request->due_date . " 11:59:59",
                'is_complete' => 0,
                'score' => 0,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]);
        }

        return redirect('/classgroups/' . $classgroup->id);
    }

    public function complete_task(Task $task)
    {
        $user = Auth::user();
        $outstandingStudents = DB::table('users')
        ->leftJoin('tasks_to_students', 'users.id', '=', 'tasks_to_students.student_id')
        ->where('tasks_to_students.task_id', '=', $task->id)
        ->get();

        $questions = DB::table('questions')
                        ->where('task_id', '=', $task->id)
                        ->get();

        foreach ($questions as $question){
            $question->options = str_replace(' ', '', explode("|", $question->options));
        }

        return view('complete_task', compact('task', 'questions'));
    }

    public function submit_task(Task $task, Request $request)
    {
        $user = Auth::user();
        $questions = DB::table('questions')
                        ->where('task_id', '=', $task->id)
                        ->get();
        $correct = 0;
        $incorrect = 0;

        foreach ($questions as $questionKey => $question){
            $question->options = str_replace(' ', '', explode("|", $question->options));
            foreach ($question->options as $optionKey => $option) {
                if ($option == $question->answer){
                    $question->answerKey = $optionKey;
                }
            }

            if ($question->answerKey == $request->input('question' . $questionKey)){
                DB::table('question_submissions')->insert([
                    'user_id' => $user->id,
                    'task_id' => $task->id,
                    'question_id' => $question->id,
                    'answer' => $request->input('question' . $questionKey),
                    'correct' => 1,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);
                $correct++;
            } else {
                DB::table('question_submissions')->insert([
                    'user_id' => $user->id,
                    'task_id' => $task->id,
                    'question_id' => $question->id,
                    'answer' => $request->input('question' . $questionKey),
                    'correct' => 0,
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]);
                $incorrect++;
            }
        }

        DB::table('task_submissions')->insert([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'number_of_questions' => count($questions),
            'number_correct' => $correct,
            'number_incorrect' => $incorrect,
            'number_unknown' => 0,
            'created_at' => NOW(),
            'updated_at' => NOW()
        ]);

        //todo, calculate the score and input
        $sql = DB::table('tasks_to_students')
                ->where('task_id', $task->id)
                ->where('student_id', $user->id)
                ->update([
                        'is_complete' => 1,
                        'score' => ($correct / count($questions)) * 100,

                ]);

        return redirect('/home');
    }
}

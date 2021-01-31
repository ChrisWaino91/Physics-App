<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function getAllTasksForStudent($userId)
    {
        return DB::table('tasks')
            ->leftJoin('tasks_to_students', 'tasks_to_students.task_id', '=', 'tasks.id')
            ->where('tasks_to_students.student_id', $userId)
            ->get();
    }
}

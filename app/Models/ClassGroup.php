<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentsToClasses;

class ClassGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students_to_classes()
    {
        return $this->hasMany(StudentsToClasses::class, 'class_id', 'id');
    }

    public static function getAllClassGroups($userId)
    {
        return ClassGroup::withCount('students_to_classes')
        ->where('user_id', Auth::user()->id)
        ->get();
    }
}

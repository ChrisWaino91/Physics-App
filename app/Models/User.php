<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ClassGroup;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function classGroup()
    {
        return $this->hasMany(classGroup::class);
    }

    public function tasks()
    {
        return $this->hasOneThrough(TasksToClasses::class, ClassGroup::class, 'user_id', 'class_id');
    }

    public static function getAllTeachers($organisationId)
    {
        return DB::table('users')
            ->where('access_level', 3)
            ->where('organisation_id', $organisationId)
            ->get();
    }



}

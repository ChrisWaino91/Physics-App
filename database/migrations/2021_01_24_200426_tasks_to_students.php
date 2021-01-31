<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TasksToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_to_students', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('task_id');
            $table->tinyInteger('student_id');
            $table->dateTime('due_date');
            $table->boolean('is_complete');
            $table->float('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_to_students', function (Blueprint $table) {
            Schema::dropIfExists('tasks_to_students');
        });
    }
}

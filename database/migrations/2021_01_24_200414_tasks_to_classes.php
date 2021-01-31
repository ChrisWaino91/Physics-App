<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TasksToClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_to_classes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('task_id');
            $table->tinyInteger('class_id');
            $table->boolean('whole_class');
            $table->tinyInteger('number_assigned_to');
            $table->tinyInteger('number_completed');
            $table->dateTime('due_date');
            $table->float('percent_completed')->nullable;
            $table->float('average_score')->nullable;
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
        Schema::table('tasks_to_classes', function (Blueprint $table) {
            Schema::dropIfExists('tasks_to_classes');
        });
    }
}

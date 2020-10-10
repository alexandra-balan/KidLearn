<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('answer');
            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('answer_id')->unsigned();
            $table->float('points');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('answer_id')->references('id')->on('student_answers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_answers', function (Blueprint $table) {
            //
        });
    }
}

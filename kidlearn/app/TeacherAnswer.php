<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherAnswer extends Model
{
    protected $fillable = [
        'answer',
        'question_id',
        'teacher_id',
        'answer_id',
        'points'
    ];

    protected $table = 'teacher_answers';

    public function question()
    {
        return $this->hasOne('App\Question', 'id', 'question_id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher', 'id', 'teacher_id');
    }

    public function answer()
    {
        return $this->hasOne('App\StudentAnswer', 'id', 'answer_id');
    }

}

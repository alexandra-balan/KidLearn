<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'max_points',
        'teacher_id',
        'subject_id'
    ];

    protected $table = 'questions';

    public function teacher()
    {
        return $this->hasOne('App\Teacher', 'id', 'teacher_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject', 'id', 'subject_id');
    }

    public function studentAnswers()
    {
        return $this->hasMany('App\StudentAnswers', 'question_id', 'id');
    }

    public function teacherAnswers()
    {
        return $this->hasMany('App\TeacherAnswers', 'question_id', 'id');
    }
}

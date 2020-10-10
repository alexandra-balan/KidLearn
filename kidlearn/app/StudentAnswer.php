<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'student_id',
        'answer'
    ];

    public function student()
    {
        return $this->hasOne('App\Student', 'id', 'student_id');
    }

    public function question()
    {
        return $this->hasOne('App\Question', 'id', 'question_id');
    }

    public function teacherAnswers()
    {
        return$this->hasOne('App\TeacherAnswer', 'answer_id', 'id');
    }
}

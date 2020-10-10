<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

   public function user()
   {
       return $this->belongsTo('App\User');
   }

   public function questions()
   {
       return $this->hasMany('App\Question', 'teacher_id', 'id');
   }

   public function teacherAnswers()
   {
       return $this->hasMany('App\TeacherAnswers', 'teacher_id', 'id');
   }

   public function subjects()
   {
       return $this->hasMany('App\Subjects', 'teacher_id', 'id');
   }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClasses extends Model
{
    protected $fillable = [
        'year',
        'label'
    ];

    protected $table = 'student_classes';

    public function students()
    {
        return $this->hasMany('App\Student', 'class_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'classes_subjects', 'class_id', 'subject_id');
    }

}

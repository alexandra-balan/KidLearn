<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'grade',
        'semester',
        'student_id',
        'class_subject_id',
        'comment'
    ];

    protected $table = 'grades';

    public function students()
    {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }



}

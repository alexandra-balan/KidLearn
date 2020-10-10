<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'class_id',
        'user_id',
        'score',
    ];

    protected $table = 'students';

    public function classes()
    {
        return $this->hasOne('App\StudentClasses', 'id', 'class_id');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'id');
    }

    public function avgGrades()
    {
        return $this->hasMany('App\Grade', 'student_id', 'id')->average('grade');
    }

    public function user()
    {
        return $this->$this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\StudentAnswer', 'student_id', 'id');
    }

}

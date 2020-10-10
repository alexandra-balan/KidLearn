<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'subjects';

    public function studentClasses()
    {
        return $this->belongsToMany('App\StudentClasses', 'classes_subjects', 'subject_id', 'class_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Questions', 'subject_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ClassSubjects implements Rule
{
    public $subjectIds;
    public $classIds;

    /**
     * Create a new rule instance.
     * @param array $subjectIds
     * @param array $classIds
     * @return void
     */
    public function __construct($subjectIds, $classIds)
    {
        $this->subjectIds = $subjectIds;
        $this->classIds = $classIds;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //dd($value);
        if (count(
            DB::table('classes_subjects')
            ->whereIn('class_id', $this->classIds)
            ->whereIn('subject_id', $this->subjectIds)->get()->toArray()
        )) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Materia introdusă există deja în una sau mai multe clase selectate.';
    }
}

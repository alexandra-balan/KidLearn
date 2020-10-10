<?php

namespace App\Repositories;

use App\Subject;
use Illuminate\Support\Facades\DB;
use App\Repositories\StudentClassesRepository;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function get($subject_id)
    {
        return Subject::find($subject_id);
    }

    public function all()
    {
        return Subject::all();
    }

    public function delete($subject_id)
    {
        Subject::destroy($subject_id);
    }

    public function update($subject_id, array $subject_data)
    {
        Subject::find($subject_id)->update($subject_data);
    }

    public function store(array $data, array $classes)
    {
        $subject = new Subject();

        $subject['subject'] = $data['subject'];
        $subject['teacher_id'] = $data['teacher_id'];
        $subject->save();
        if (count($classes)) {
            foreach ($classes as $class) {

                $studentClassRepository = new StudentClassesRepository();
                $class_id = $studentClassRepository->getClassByName($class)->id;
                $subject->studentClasses()->attach($class_id);

            }

        }


    }
}

<?php

namespace App\Repositories;

use App\Student;
use App\StudentClasses;
use Illuminate\Support\Facades\DB;

class StudentClassesRepository implements StudentClassesRepositoryInterface
{
    public function get($id)
    {
        return StudentClasses::find($id);
    }

    public function all()
    {
        return StudentClasses::all();
    }

    public function delete($id)
    {
        StudentClasses::destroy($id);
    }

    public function update($id, array $data)
    {
        StudentClasses::find($id)->update($data);
    }

    public function store(array $data)
    {
        StudentClasses::create($data);
    }

    public function getClassByName($name)
    {
        $class = StudentClasses::where('year', '=', substr($name, 0, strlen($name) - 1))
            ->Where('label', '=', $name[strlen($name) - 1])->get()->first();

        return $class;
    }

    public function semiAnnualReport($id)
    {
        $students = Student::where('class_id', $id)->get();
      //  dd($students);
        $class = $this->get($id);
        $reports = array();

        foreach ($students as $student) {

            $totalGrades1 = 0;
            $totalGrades2 = 0;
            $average1 = 0;
            $average2 = 0;
            $numberOfGrades1 = 0;
            $numberOfGrades2 = 0;

            $grades = $student->grades()->get()->toArray();

            foreach ($grades as $grade) {
                if ($grade['semester'] == 1) {
                    $totalGrades1 += $grade['grade'];
                    $numberOfGrades1++;
                } else {
                    $totalGrades2 += $grade['grade'];
                    $numberOfGrades2++;
                }
            }
            if ($numberOfGrades1) {
                $average1 = $totalGrades1 / $numberOfGrades1;

            }
            if ($numberOfGrades2) {
                $average2 = $totalGrades2 / $numberOfGrades2;
            }
            if ($average1 && $average2) {
                array_push($reports,
                    [
                        'year' => $class->year,
                        'label' => $class->label,
                        'name' => $student->name,
                        'avg1' => $average1,
                        'avg2' => $average2
                    ]);
            }

        }
        return $reports;
    }

    public function annualReport($id)
    {
        $students = Student::where('class_id', $id)->get();
        $class = $this->get($id);
        $reports = array();

        foreach ($students as $student) {

            $grades = $student->avgGrades();

            if ($grades) {
                array_push($reports,
                    [
                        'year' => $class->year,
                        'label' => $class->label,
                        'name' => $student->name,
                        'avg' => round($grades, 3)
                    ]);
            }

        }
        return $reports;
    }

    public function classGraduationRate($id)
    {
        $students = Student::where('class_id', $id)->get();
        $passed = 0;
        $totalStudents = 0;
        foreach ($students as $student) {

            $grades = $student->avgGrades();

            if ($grades) {

                $totalStudents++;
                if ($grades >= 5) {

                    $passed++;

                }
            }

        }

        if ($totalStudents) {
            $result = ($passed * 100) / $totalStudents;

            return $result;
        }

        return 0;

    }

    public function totalGraduationRate()
    {
        $classes = StudentClasses::all();
        $totalResult = 0;
        foreach ($classes as $class) {
            $totalResult += $this->classGraduationRate($class['id']);
        }

        return $totalResult;
    }

    public function graduationRate($id)
    {
        $classGraduationRate = $this->classGraduationRate($id);
        $totalGraduationRate = $this->totalGraduationRate();

        $class = StudentClasses::find($id);
        $reports = array();
        array_push($reports, [
            'year' => $class->year,
            'label' => $class->label,
            'classGR' => $classGraduationRate,
            'totalGR' => $totalGraduationRate
        ]);

        return $reports;
    }

}

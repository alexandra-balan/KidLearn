<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Student;
use App\StudentClasses;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', compact($grades));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($student_id)
    {
        $subjects = $this->getStudentSubjects($student_id);

        $studentName = Student::where('id', $student_id)->get()->first()['name'];
        return view('grades.create', compact('subjects', 'student_id', 'studentName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $student_id)
    {
        //dd($request->all());
        $messages = [
            'grade.required' => 'Nota este obligatorie',
            'subject.required' => 'Materia este obligatorie',
            'semester.required' => 'Semestrul este obligatoriu',
            'comment.max' => 'Comentariul poate contine maxim 255 de caractere',
        ];

        $validator = Validator::make($request->all(), [
            'grade' => 'required|',
            'subject' => 'required',
            'semester' => 'required',
            'comment' => 'nullable|string|max:255'
        ], $messages);

        if ($validator->fails()) {
            return redirect('/grades/create' . $student_id)->withInput()->withErrors($validator);
        } else {
            $class_subject = $this->getClassSubject($student_id, $request->get('subject'))[0]->id;

            $grade = new Grade();
            $grade['grade'] = $request->get('grade');
            $grade['semester'] = $request->get('semester');
            $grade['comment'] = $request->get('comment');
            $grade['student_id'] = $student_id;
            $grade['class_subject_id'] = $class_subject;

            $grade->save();

             return redirect('/students')->with('succes', 'Grade saved');
        }
    }

    public function addComment($grade_id)
    {
        return view('grades.addComment', compact('grade_id'));
    }

    public function storeComment(Request $request, $grade_id)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect('grades/addComment')->withInput()->withErrors($validator);
        } else {
            $grade = Grade::find($grade_id);
            $grade['comment'] = $request->get('comment');
            $grade->save();

            return redirect('/students')->with('succes', 'Comment saved');

        }

    }
    /**
     * Display the specified resource.
     *
     * @param \App\Grade $grade
     * @return \Illuminate\Http\Response
     */
    public function show(?Request $request, int $id)
    {
        $filter = $request->get('filter') ?? '';
        $sorter = $request->get('sorter') ?? '';

        $students = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->join('classes_subjects', 'classes_subjects.id', '=', 'grades.class_subject_id')
            ->join('subjects', 'subjects.id', '=', 'classes_subjects.subject_id')
            ->where('students.id', '=', $id)

            ->select('grades.id as grade_id', 'grades.grade as grade', 'grades.semester as semester', 'grades.comment as comment', 'subjects.subject as subject');

        switch ($sorter) {
            case 'Ascendent' :
                $students = $students->orderBy('grades.grade');//->paginate(9);
                break;
            case 'Descendent':
                $students = $students->orderByDesc('grades.grade');//->paginate(9);
                break;
        }

        if ($filter) {
            $students->where('subjects.subject', $filter);
        }
        $students = $students->paginate(10);

        $class_id = Student::find($id)->class_id;
        $class = StudentClasses::find($class_id);
        $year = $class->year;
        $label = $class->label;
        $name = Student::find($id)->name;
        $subjects = DB::table('grades')
            ->join('classes_subjects', 'classes_subjects.id', '=', 'grades.class_subject_id')
            ->join('subjects', 'subjects.id', 'classes_subjects.subject_id')
            ->where('grades.student_id', $id)
            ->get()->toArray();
        $uniqueSubjects = array_unique(array_pluck($subjects, 'subject'));

        $medie = DB::table('grades')
            ->where('student_id', $id)
            ->average('grade');

        $medie = doubleval($medie);
        return view ('grades.show', compact(
            'students', 'year', 'label', 'name',  'medie', 'id', 'filter', 'sorter', 'uniqueSubjects'
        ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Grade $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Grade $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Grade $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }

    private function getStudentSubjects($student_id)
    {
        $userId = Auth::user()->id;
        $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
        $subjects = Student::find($student_id)->classes()->with('subjects')->get()->toArray();
        $studentSubjects = array();
        foreach ($subjects as $item) {
            foreach ($item['subjects'] as $subject) {
                if($subject['teacher_id'] == $teacherId) {
                    $studentSubjects[] = $subject['subject'];
                }
            }
        }
        return array_unique($studentSubjects);
    }

    private function getClassSubject($student_id, $subject_name)
    {

        $class_id = DB::table('students')->where('id', $student_id)->select('class_id')->get()->toArray();
//        dd($class_id[0]->class_id);
        $subject_id = DB::table('subjects')
            ->join('classes_subjects', 'classes_subjects.subject_id', '=','subjects.id')
            ->where('subjects.subject',  $subject_name)
            ->where('classes_subjects.class_id', '=', $class_id[0]->class_id)
            ->select('subjects.id')->get()->toArray();
       // dd($subject_id);
        $class_id = $class_id[0]->class_id;
        $subject_id = $subject_id[0]->id;
        $class = DB::table('classes_subjects')
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->select('id');

        return $class->get()->toArray();
    }
}

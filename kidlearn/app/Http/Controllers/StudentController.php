<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Question;
use App\Student;
use App\StudentAnswer;
use App\StudentClasses;
use App\Teacher;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function Sodium\compare;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        $students = [];

//dd($request->all());
        if (!$request->get('filter')) {
          //  dd($request->all());
            $filter = '';
            $students = Student::with('classes')->paginate(5);
//            dd($students);
            return view('students.index', compact('students', 'filter'));
        }
        $filter = $request->get('filter');
        switch ($filter) {
            case 'AscendentNume' :
                $students = Student::with('classes')->orderBy('name')->paginate(5);
                break;
            case 'DescendentNume':
                $students = Student::with('classes')->orderByDesc('name')->paginate(5);
                break;
            case 'AscendentScor':
                $students = Student::with('classes')->orderBy('score')->paginate(5);
                break;
            case 'DescendentScor':
                $students = Student::with('classes')->orderByDesc('score')->paginate(5);
                break;
        }
       // $students = Student::with('classes')->orderBy('name')->paginate(5);
      //  dd($students);
//        $class = StudentClasses::find($class_id);
//        $year = $class->year;
//        $label = $class->label;
//         dd($students);
        return view('students.index', compact('students', 'filter'))->render();
    }

    public function order(Request $request)
    {
        if (!$request->get('filter')) {
            $students = Student::with('classes')->paginate(5);
            return view('students.index', compact('students'));
        }
        $filter = $request->get('filter');
        switch ($filter) {
            case 'AscendentNume' :
                $students = Student::with('classes')->orderBy('name')->paginate(5);
                break;
            case 'DescendentNume':
                $students = Student::with('classes')->orderByDesc('name')->paginate(5);
                break;
            case 'AscendentScor':
                $students = Student::with('classes')->orderBy('score')->paginate(5);
                break;
            case 'DescendentScor':
                $students = Student::with('classes')->orderByDesc('score')->paginate(5);
                break;
        }
        dump($students);
        return view('students.ordered', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->getAllClasses();
        return view('students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Numele este obligatoriu',
            'username.required' => 'Numele de utilizator este obligatoriu',
            'username.alpha_num' => 'Numele de utilizator poate contine doar litere si cifre',
            'password.alpha_num' => 'Parola poate contine doar litere si cifre',
            'class_list.required' => 'Clasa este obligatorie',
            'password.required' => 'Parola este obligatorie',
            'password.min' => 'Parola trebuie sa contina minim 8 caractere',
            'name.min' => 'Numele trebuie sa contina minim 4 caractere',
            'name.max' => 'Numele trebuie sa contina maxim 30 caractere',
            'username.max' => 'Numele de utilizator trebuie sa contina maxim 30 caractere',
            'name.regex' => 'Numele poate contine doar litere si spatiu'
            ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:30|min:4',
            'class_list' => 'required',
            'username' => 'required|alpha_num|max:30|unique:users',
            'password' => 'required|alpha_num|min:8',

        ], $messages);

        if ($validator->fails()) {
            return redirect('students/create')->withInput()->withErrors($validator);
        } else {

            $class = $this->getClassByName($request->input('class_list'));
            $student = new Student();
            $student['class_id'] = $class->id;
            $student['name'] = $request->get('name');

            $user = User::create([
                'name' => $student['name'],
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
                'role' => 'Elev'
            ]);

            $student->user_id = $user->id;
            $student->score = 0;


            $student->save();

            return redirect('/students')->with('succes', 'Student saved');
        }
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'searchName' => 'string|max:30|'
        ]);
        if ($validator->fails()) {
            return view('students.searchNotOk');
        } else {
            $name = $request->get('searchName');
            try {
                $students = DB::table('students')->where('name', 'like', '%' . $name . '%')->get();
            } catch (\Exception $exception) {
                return view('students.searchNotOk');
            }

            try {
                $questions = DB::table('questions')->where('question', 'like', '%' . $name . '%')->get();
            } catch (\Exception $exception) {
                return view('students.searchNotOk');
            }
            //dd($students, $subjects, $questions);

            return view('students.searchResult', compact('students', 'subjects', 'questions'));

        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = DB::table('students')
            ->join('grades', 'students.id', '=', 'grades.student_id')
            ->join('classes_subjects', 'classes_subjects.id', '=', 'grades.class_subject_id')
            ->join('subjects', 'subjects.id', '=', 'classes_subjects.subject_id')
            ->where('students.id', '=', $id)
            ->select('grades.id as grade_id', 'grades.grade as grade', 'grades.semester as semester', 'grades.comment as comment', 'subjects.subject as subject')
            ->paginate(10);
        //dd($students);
        $class_id = Student::find($id)->class_id;
        $class = StudentClasses::find($class_id);
        $year = $class->year;
        $label = $class->label;
        $name = Student::find($id)->name;
        $answers = StudentAnswer::where('student_id', $id)->with('question')->with('teacherAnswers')
            ->paginate(10);
       //dd($answers->first()->teacherAnswers);

        $medie = DB::table('grades')
            ->where('student_id', $id)
            ->average('grade');

        $punctaj = DB::table('student_answers')
            ->join('teacher_answers', 'teacher_answers.answer_id', '=', 'student_answers.id')
            ->where('student_answers.student_id', $id)
            ->sum('teacher_answers.points');
       // dd($punctaj);

        $punctaj = doubleval($punctaj);
        $medie = doubleval($medie);
        return view ('students.show', compact(
            'students', 'year', 'label', 'name', 'answers', 'medie', 'punctaj', 'id'
        ));

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }


    public function profile()
    {
        return view('students.profile');
    }

    public function savePassword(Request $request)
    {
      //  dd($request->all());
        $messages = [
            'password.required' => 'Parola este obligatorie',
            'password.min' => 'Parola trebuie sa contina minim 8 caractere',
        ];
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8'],
        ], $messages);

        if ($validator->fails()) {
            return redirect('students/change-password')->withInput()->withErrors($validator);
        } else {
        $user['password'] = Hash::make($request->get('password'));
        $user->save();
        Auth::logout();
        return redirect('/home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }


    private function getAllClasses()
    {
        $classes = StudentClasses::all()->toArray();

        return $classes;
    }

    private function getClassByName($name)
    {
        $class = StudentClasses::where('year', '=', substr($name, 0, strlen($name) - 1))
            ->Where('label', '=', $name[strlen($name) - 1])->get()->first();

        return $class;
    }


}

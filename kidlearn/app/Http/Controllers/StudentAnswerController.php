<?php

namespace App\Http\Controllers;

use App\Question;
use App\Student;
use App\StudentAnswer;
use App\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware("student")->only('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRole = Auth::user()->role;
        if($userRole == 'Profesor') {
            $userId = Auth::user()->id;
            $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
            $studentAnswers = DB::table('student_answers')
                ->join('questions', 'questions.id', 'student_answers.question_id')
                ->join('subjects', 'questions.subject_id', 'subjects.id')
                ->join('students', 'student_answers.student_id', 'students.id')
                ->where('subjects.teacher_id', $teacherId)
                ->select('student_answers.id as answerId', 'student_answers.answer as answer', 'subjects.subject as subject',
                    'students.name as name')
                ->paginate(10);

            $studentAnswers = ['answers' => $studentAnswers];
//      dd($studentAnswers);
            return view('studentAnswers.index', $studentAnswers);
        }
        else if ($userRole == 'Elev') {
            $userId = Auth::user()->id;
            $studentId = Student::where('user_id', $userId)->get()->first()['id'];
//            $studentAnswers = DB::table('student_answers')
//                ->join('questions', 'questions.id', 'student_answers.question_id')
//                ->join('subjects', 'questions.subject_id', 'subjects.id')
//                ->join('students', 'student_answers.student_id', 'students.id')
//                ->where('students.id', $studentId)
//                ->select('student_answers.id as answerId', 'student_answers.answer as answer', 'subjects.subject as subject',
//                    'students.name as name')
//                ->paginate(10);
//
//            $studentAnswers = ['answers' => $studentAnswers];
//   //   dd($studentAnswers);
//            return view('studentAnswers.index', $studentAnswers);
            return $this->show($studentId);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($questionId)
    {
        $question = Question::where('id', $questionId)->with('subject')->get()->first();
       // dd($question);
        return view('studentAnswers.create', compact('questionId', 'question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $questionId)
    {
        $messages = [
            'answer.required' => 'Raspunsul este obligatoriu'
        ];
        //dd(Auth::user());
        $validator = Validator::make($request->all(), [
           'answer' => 'required|string'
        ], $messages);
        if ($validator->fails()) {
            return redirect('studentAnswers/create/' . $questionId)->withInput()->withErrors($validator);
        }
        else {
            $data = [
                'answer' => $request->get('answer'),
                'question_id' => $questionId,
                ];
            $answer = new StudentAnswer();
            $answer['answer'] = $data['answer'];
            $answer['question_id'] = $data['question_id'];
            $userId = Auth::user()->id;
            $studentId = Student::where('user_id', $userId)->get()->first()['id'];
            $student_id = $studentId;
            $answer['student_id'] = $student_id;
            $answer->save();
            return redirect('/questions')->with('succes', 'Answer saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentAnswer  $studentAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
//        $userId = Auth::user()->id;
//        $studentId = Student::where('user_id', $userId)->get()->first()['id'];
//        $studentAnswers = DB::table('student_answers')
//            ->join('questions', 'questions.id', 'student_answers.question_id')
//            ->join('subjects', 'questions.subject_id', 'subjects.id')
//            ->where('student_answers.student_id', $id)
//            ->get()->toArray();

        $studentAnswers = StudentAnswer::where('student_id', $id)->with('question')->with('teacherAnswers');
//        $studentAnswers = ['answers' => $studentAnswers->get()->toArray()];
        $studentAnswers = $studentAnswers->get()->toArray();
//dd($studentAnswers);
        return view('studentAnswers.show', compact('studentAnswers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentAnswer  $studentAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAnswerController $studentAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentAnswer  $studentAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAnswerController $studentAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentAnswer  $studentAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAnswerController $studentAnswer)
    {
        //
    }
}

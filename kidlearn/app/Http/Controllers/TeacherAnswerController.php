<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentAnswer;
use App\Teacher;
use App\TeacherAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
        $Tanswers = DB::table('teacher_answers')
            ->join('questions', 'questions.id', 'teacher_answers.question_id')
            ->join('student_answers', 'student_answers.id', 'teacher_answers.answer_id')

            ->join('subjects', 'questions.subject_id', 'subjects.id')
            ->join('students', 'students.id', 'student_answers.student_id')
            //->where('teacher_answers.answer_id', 'student_answers.id')

            ->where('subjects.teacher_id', $teacherId)
            ->where('teacher_answers.teacher_id', $teacherId)
            ->select('student_answers.id as answerId', 'student_answers.answer as answer', 'subjects.subject as subject',
                'students.name as name', 'teacher_answers.answer as teacherAnswer', 'teacher_answers.id as tId')
            ->paginate(10);
        $answers = ['answers' => $Tanswers];
      //dd($answers);
        return view('teacherAnswers.index', $answers);

        //$answers = ['answers' => TeacherAnswer::all()];
        //dd($answers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($studentAnswerId)
    {
        $question = StudentAnswer::where('id', $studentAnswerId)
            ->with('question')->get()->first()->question;
        $studentAnswer = StudentAnswer::where('id',$studentAnswerId)
            ->get()->first();
        return view('teacherAnswers.create', compact('studentAnswerId', 'question', 'studentAnswer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $studentAnswerId)
    {
        $messages = [
            'points.required' => 'Punctajul este obligatoriu',
            'points.min' => 'Punctajul trebuie sa fie mai mare ca 0',
            'points.numeric' => 'Punctajul trebuie sa fie cuprins intre 0 si 100 si poate avea doua zecimale',
            'points.between' => 'Punctajul trebuie sa fie cuprins intre 0 si 100 si poate avea doua zecimale',
            'points.max' => 'Punctajul trebuie sa fie mai mic ca 100',
            'answer.required' => 'Raspunsul este obligatoriu',
        ];
        $validator = Validator::make($request->all(), [
            'answer' => 'required|string',
            'points' => 'required|numeric|between:0,100.00'
        ], $messages);
        if ($validator->fails()) {
            return redirect('teacherAnswers/create/' . $studentAnswerId)->withInput()->withErrors($validator);
        }
        else {
            $data = [
                'answer' => $request->get('answer'),
                'answer_id' => $studentAnswerId,
            ];
            $answer = new TeacherAnswer();
            $answer['answer'] = $data['answer'];
            $answer['answer_id'] = $data['answer_id'];
            $userId = Auth::user()->id;
            $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
            $teacher_id = $teacherId ;
            $answer['teacher_id'] = $teacher_id;
            $answer['points'] = $request->get('points');
            $answer['question_id'] = StudentAnswer::where('id', $studentAnswerId)->get()->toArray()[0]['question_id'];
            $answer->save();
            $studentId = StudentAnswer::where('id', $studentAnswerId)->get()->first()['student_id'];
            $studentScore = StudentAnswer::where('id', $studentAnswerId)->get()->first()['score'];
            DB::table('students')
                ->where('id', $studentId)
                ->update(['score' => $studentScore + $request->get('points')]);


            return redirect('/teacherAnswers')->with('succes', 'Answer saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeacherAnswer  $teacherAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherAnswerController $teacherAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeacherAnswer  $teacherAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherAnswerController $teacherAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeacherAnswer  $teacherAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherAnswerController $teacherAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeacherAnswer  $teacherAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherAnswerController $teacherAnswer)
    {
        //
    }
}

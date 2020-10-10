<?php

namespace App\Http\Controllers;

use App\Question;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder;

class QuestionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        $questions = Question::with('teacher')->with('subject');
        $filter = $request->get('filter') ?? '';
        $sorter = $request->get('sorter') ?? '';

        switch ($sorter) {
            case 'ascScor' :
             $questions = $questions->orderBy('max_points');//->paginate(9);
                break;
            case 'descScor':
               $questions = $questions->orderByDesc('max_points');//->paginate(9);
                break;
        }

//        dd($filter);

        if ($filter) {
           $questions = $questions->where('subject_id', $filter);
        }

        $questions = $questions->paginate(9);

        $subjects = Subject::all()->unique('subject');

        //dd($questions);
        return view('questions.index', compact('questions', 'subjects', 'sorter', 'filter'))->render();
    }

    public function filter(Request $request)
    {
       // dd($request);
        $subjects = Subject::all();
        //dd($request->get('subject'));
        $questions = Question::where('subject_id', $request->get('subject'))->with('teacher')->with('subject')
            ->orderBy('max_points')
            ->paginate(9);

       // dd($questions);
        return view('questions.index', compact('questions', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = $this->getAllSubjects();
        return view('questions.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'question.required' => 'Enuntul este obligatoriu',
            'max_points.required' => 'Punctajul este obligatoriu',
            'max_points.min' => 'Punctajul trebuie sa fie mai mare ca 0',
            'max_points.numeric' => 'Punctajul trebuie sa fie cuprins intre 0 si 100 si poate avea doua zecimale',
            'max_points.between' => 'Punctajul trebuie sa fie cuprins intre 0 si 100 si poate avea doua zecimale',
            'max_points.max' => 'Punctajul trebuie sa fie mai mic ca 100',
            'subject.required' => 'Materia este obligatorie',

        ];
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'max_points' => 'required|numeric|between:0,100.00',
            'subject' => 'required'
        ],$messages);
        if ($validator->fails()) {
            return redirect('questions/create')->withInput()->withErrors($validator);
        }
        else {
           // dd($request->get('max_points'));
            $data = [
                'question' => $request->get('question'),
                'max_points' => $request->get('max_points'),
                'teacher_id' => Auth::user()->teacher()->get()->toArray()[0]['id'],
                'subject_id' => $this->getSubject($request->get('subject')),
            ];

            $question = new Question();
            $question['question'] = $data['question'];
            $question['max_points'] = $data['max_points'];
            $question['teacher_id'] = $data['teacher_id'];
            $question['subject_id'] = $data['subject_id'];
            $question->save();
//            $question->teacher()->attach($request->get('teacher_id'));
//            $question->subject()->attach($request->get('subject_id'));

            return redirect('/questions')->with('succes', 'Question saved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(int $questionId)
    {
        $question = Question::with('teacher')->with('subject')->where('id', $questionId)->get()->first();
       // dd($question);
        return view('questions.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    protected function getAllSubjects()
    {
        $userId = Auth::user()->id;
        $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
        $subjects = Subject::where('teacher_id', $teacherId)->get()->toArray();
        return array_unique(array_pluck($subjects, 'subject'));
    }

    protected function getSubject($subject)
    {
       // dd($subject, Subject::where('subject', $subject)->get()->first()['id']);
        return Subject::where('subject', $subject)->get()->first()['id'];
    }
}

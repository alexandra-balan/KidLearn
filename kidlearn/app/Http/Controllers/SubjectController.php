<?php

namespace App\Http\Controllers;

use App\Repositories\StudentClassesRepository;
use App\Repositories\SubjectRepositoryInterface;
use App\Rules\ClassSubjects;
use App\StudentClasses;
use App\Subject;
use App\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        if (!$request->get('sorter')) {
            $sorter = '';
            $subjects = Subject::with('studentClasses')->with('teacher')->paginate(5);
            return view('subjects.index', compact('subjects', 'sorter'))->render();
        }
        $sorter = $request->get('sorter');
        switch ($sorter) {
            case 'AscendentNume' :
                $subjects = Subject::orderBy('subject')->paginate(5);
                break;
            case 'DescendentNume' :
                $subjects = Subject::orderByDesc('subject')->paginate(5);
                break;
        }
        return view('subjects.index', compact('subjects', 'sorter'))->render();

    }

    public function order(Request $request)
    {
        $subjects = Subject::orderBy('subject')->paginate(5);
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->getAllClasses();
        return view('subjects.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $message = [
            'subject.required' => 'Materia este obligatorie',
            'class_list.required' => 'Trebuie sa selectezi una sau mai multe clase',
            ];
        $class_list = $request->get('class_list');
        $classIds = [];
        if (count($class_list)) {
            foreach ($class_list as $class) {
                $studentClassRepository = new StudentClassesRepository();
                $classIds[] = $studentClassRepository->getClassByName($class)->id;
            }
        }
        $userId = Auth::user()->id;
        $teacherId = Teacher::where('user_id', $userId)->get()->first()['id'];
       // dd($teacherId);
       $subject = $request->get('subject');
        $subjectId = Subject::where('subject', $subject)->get();
        $subjectIds = array_pluck($subjectId, 'id');
        $data = ['subject' => $request->get('subject'),
            'classIds' => $classIds];
        //dd($subjectIds);
   //   dd(  count(DB::table('classes_subjects')->whereIn('class_id', $classIds)
        //    ->whereIn('subject_id', $subjectIds)->get()->toArray()));
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'class_list' => ['required', new ClassSubjects($subjectIds, $classIds)]

        ], $message);
        if ($validator->fails()) {
            return redirect('subjects/create')->withInput()->withErrors($validator);
        } else {

            $data = [
                'subject' => $request->get('subject'),
                'teacher_id' => $teacherId
            ];

            $classes = $request->get('class_list');
            $this->subject->store($data, $classes);

            return redirect('/subjects')->with('succes', 'Subject saved');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $subjectId)
    {
        $subject = Subject::find($subjectId);
//        $class = DB::table('classes_subjects')
//            ->where('subject_id', '=', $subjectId)
//            ->delete();
        $subject->delete();
        return redirect('/subjects')->with('success', 'Materie stearsa!');
    }

    private function getAllClasses()
    {
        $classes = StudentClasses::all()->toArray();

        return $classes;
    }

}

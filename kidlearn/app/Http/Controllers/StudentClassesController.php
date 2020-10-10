<?php

namespace App\Http\Controllers;

use App\Repositories\StudentClassesRepository;
use App\Repositories\StudentClassesRepositoryInterface;
use App\Student;
use App\StudentClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentClassesController extends Controller
{
    protected $studentClasses;

    public function __construct(StudentClassesRepositoryInterface $studentClasses)
    {
        $this->studentClasses = $studentClasses;
    }

    /**
     * Display a listing of the resource.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(?Request $request)
    {
        $classes = StudentClasses::paginate(5);
     //   dd($request->all());
        $sorter = $request->get('sorter') ?? '';
        switch ($sorter) {
            case 'Ascendent' :
                $classes = StudentClasses::orderBy('year')->orderBy('label')->paginate(5);
                break;
            case 'Descendent':
                $classes = StudentClasses::orderByDesc('year')->orderByDesc('label')->paginate(5);
                break;
        }

        return view('studentClasses.index', compact('classes', 'sorter'))->render();
    }

    public function order(Request $request)
    {
        $classes = StudentClasses::orderBy('year')->orderBy('label')->paginate(5);
        return view('studentClasses.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentClasses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'label.unique' => 'Combinatia dintre an si serie nu este unica',
            'label.required' => 'Seria este obligatorie',
            'year.required' => 'Anul este obligatoriu',
            'label.max' => 'Seria poate fi reprezentata printr-o singura litera',
            'label.alpha' => 'Seria poate contine doar o litera'
            ];
        $year = $request->get('year');
        $label = $request->input('label');

        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'label' => ['required', 'max:1', 'alpha',
                Rule::unique('student_classes')->where(function ($q) use ($year, $label) {
                    return $q->where('year', $year)->where('label', $label);
                }),
            ],
        ], $message);

        if ($validator->fails()) {
            return redirect('studentClasses/create')->withInput()->withErrors($validator);
        } else {
            $data = ['year' => $request->input('year'),
                'label' => $request->get('label')];

            $this->studentClasses->store($data);

            return redirect('/studentClasses')->with('succes', 'Class saved');
        }
    }

    public function semiAnnualReport($id)
    {

        $reports = $this->studentClasses->semiAnnualReport($id);

        return view('studentClasses.semiAnnualReport', compact('reports'));


    }

    public function annualReport($id)
    {
        $reports = $this->studentClasses->annualReport($id);

        return view('studentClasses.annualReport', compact('reports'));

    }


    public function graduationRate($id)
    {
        $reports = $this->studentClasses->graduationRate($id);

        return view('studentClasses.graduationRate', compact('reports'));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\StudentClasses $studentClasses
     * @return \Illuminate\Http\Response
     */
    public function show(StudentClasses $studentClasses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\StudentClasses $studentClasses
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentClasses $studentClasses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\StudentClasses $studentClasses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentClasses $studentClasses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\StudentClasses $studentClasses
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $classId)
    {
      //  dd($classId);
        $class = StudentClasses::find($classId);
        $class->delete();
        return redirect('/studentClasses')->with('success', 'Clasa si toti elevii sai au fost stersi');
    }
}

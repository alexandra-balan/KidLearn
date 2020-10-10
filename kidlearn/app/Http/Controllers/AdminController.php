<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::where('role', '<>', 'Admin')->get();
        $nrProfesori = User::where('role', 'Profesor')->count();
        $nrUsers = User::all()->count();
        $nrElevi = User::where('role', 'Elev')->count();
        $nrAdministratori = User::where('role', 'Administrator')->count();
        $faraRol = $nrUsers - $nrElevi - $nrProfesori - $nrAdministratori;
        $rezultat = [
            'nrProfesori' => ($nrProfesori * 100)/$nrUsers,
            'nrElevi' => ($nrElevi * 100)/$nrUsers,
            'faraRol' => ($faraRol * 100)/$nrUsers
        ];
     //  dd($rezultat);
        return view('admin.index', compact('rezultat', 'users'));
    }


    public function filter(Request $request)
    {
        $users = User::where('role',  $request->input('filter'))->get();
       // dd($users);
       // return redirect('/admin')->with('users', $users);
        return view('admin.index', compact('users'));
    }

    public function edit(int $id)
    {
        $user = User::find($id);
       // $roles = ['Admin', 'Teacher', 'Student'];
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
//        $messages = [
//            'name.required' => 'Numele este obligatoriu',
//            'role.required' => 'Rolul este obligatoriu',
//            'username.required' => 'Numele de utilizator este obligatoriu'
//            'name.string' => 'Rolul este obligatoriu',
//            'role.required' => 'Rolul este obligatoriu',
//            ];
//        $rules = [];
//        $validator = Validator::make($request->all(), $rules, $messages);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'role' => ['required', Rule::in(['Administrator', 'Profesor', 'Elev']),]
        ]);

        $user = User::find($id);
        if ($validator->fails()) {
            return redirect('admin/' . $id . '/edit')->withInput()->withErrors($validator);
        } else {
            $user->update($request->all());
            return redirect('admin/')->with('Success');
        }
    }
}

@extends('base')
@extends('layouts.app')
@section('main')
    <div>@if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif</div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Utilizatori</h1>

            <form method="POST" action="{{route('filter')}}" class="row">
                {{ csrf_field() }}
                <div class="form-group col-sm-3">

                    <select class="form-control" name="filter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="Profesor">Profesori</option>
                        <option value="Elev">Elevi</option>
                        <option value="Administrator">Administratori</option>
                        <option value="N/A">Fără rol</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrează</button>
            </form>

            <br>


            {{--            <div class="progress">--}}
            {{--                <div class="progress-bar" role="progressbar" style="width: {{$rezultat['nrProfesori']}}%" aria-valuenow="{{$rezultat['nrProfesori']}}" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                <div class="progress-bar bg-success" role="progressbar" style="width: {{$rezultat['nrElevi']}}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                <div class="progress-bar bg-info" role="progressbar" style="width: {{$rezultat['faraRol']}}%" aria-valuenow="{{$rezultat['faraRol']}}" aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--            </div>--}}
            {{--            <div class="row">--}}
            {{--                <div class="badge badge-secondary col-sm-3">Profesori</div>--}}
            {{--                <div class="badge badge-success col-sm-3">Elevi</div>--}}
            {{--                <div class="badge badge-info col-sm-3">Neverificat</div>--}}
            {{--                <div class="badge badge-light col-sm-3">Administratori</div>--}}
            {{--            </div>--}}

            <div class="container justify-content-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nume</td>
                        <td>Nume de utlizator</td>
                        <td colspan=4>Rol</td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}} </td>
                            <td>{{$user->username}} </td>
                            <td>{{$user->role}} </td>

                            <td>
                                <form method="get" action="{{route('admin.edit', $user->id)}}">
                                    <a href="{{ route('admin.edit',$user->id)}}" class="btn btn-primary">Modifică datele
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
{{--                {{$users->links()}}--}}
            </div>
            <div>
            </div>
@endsection

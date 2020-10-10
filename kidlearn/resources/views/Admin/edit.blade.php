@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Modifica datele utilizatorului</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <form method="post" action="{{ route('admin.update', $user->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Nume :</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}"/>


                        <label for="username">Nume de utilizator :</label>
                        <input type="text" class="form-control" name="username" value="{{$user->username}}"/>


                        <label for="class">Rol :</label>
                        <select class="form-control" name="role">
                            <option value="" selected disabled hidden>Choose here</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Elev">Elev</option>
                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary">Salvează modificările</button>
                </form>
            </div>
        </div>
    </div>
@endsection

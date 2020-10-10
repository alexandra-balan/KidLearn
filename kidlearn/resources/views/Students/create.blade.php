@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga un nou elev</h1>
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
                <form method="post" action="{{ route('students.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nume complet :</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}"/>


                        <label for="username">Nume de utilizator :</label>
                        <input type="text" class="form-control" name="username" value="{{old('username')}}"/>


                        <label for="password">{{ __('Parolă') }}</label>
                        <input id="password" type="password" class="form-control" name="password">


                        <label for="class">Clasă :</label>
                        <select class="form-control" name="class_list">
                            <option value="" selected disabled hidden>Alege o clasă</option>
                            @foreach($classes as $class)
                                <option value="{{$class['year']}} {{$class['label']}}">{{$class['year']}} {{$class['label']}}  </option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Salvează datele</button>
                </form>
            </div>
        </div>
    </div>
@endsection

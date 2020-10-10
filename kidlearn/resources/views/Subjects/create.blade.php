@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga o noua materie</h1>
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
                <form method="post" action="{{ route('subjects.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject">Materie :</label>
                        <input type="text" class="form-control" name="subject" value="{{old('subject')}}"/>

                        <label for="class">Clasa :</label>
                        <select multiple="" class="form-control" name="class_list[]">
                            <option value="" selected disabled hidden>Alege aici</option>
                            @foreach($classes as $class)
                                <option value="{{$class['year']}} {{$class['label']}}">{{$class['year']}} {{$class['label']}}  </option>
                            @endforeach
                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary">Adauga materia</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga o intrebare</h1>
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
                <form method="post" action="{{ route('questions.store') }}">
                    @csrf
                    <div class="form-group">

                        <p class="text-secondary h4">Întrebarea :</p>
                        <textarea class="form-control" name="question" rows="6">{{{old('question') }}}</textarea>

                        <label for="class">Materia :</label>
                        <select class="form-control" name="subject">
                            <option value="" selected disabled hidden>Alege aici</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject}} ">{{$subject}} </option>
                            @endforeach
                        </select>

                        <label for="max_points">Puncte :</label>
                        <input type="number" step="0.01" class="form-control" name="max_points" value="{{old('max_points')}}"/>

                    </div>


                    <button type="submit" class="btn btn-primary">Salvează datele</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('base')
@extends('layouts.app')
@section('main')
    <div>@if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <div class="row justify-content-between align-content-center">
        <div class="col-sm-12">

            <div class="list-group">
                <a href="#"
                   class="list-group-item list-group-item-action flex-column align-items-start list-group-item-dark">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"></h5>
                        <span class="badge badge-pill badge-secondary">
                                <small class="h6">Puncte: {{$question->max_points}}</small>
                                </span>
                    </div>
                    <p class="mb-1 h4 font-weight-bold">
                        {{$question->question}}
                    </p>
                    <br>
                    <span class="badge badge-pill badge-secondary">
                                <small class="h6">{{$question->subject->subject}}</small>
                            </span>

                </a>

            </div>
            <br>
            <br>
            @if(Auth::user()->role == 'Elev' )
            <a href="{{route('createStudentAnswer', $question->id)}}"><h5>Răspunde</h5></a>
            @endif
{{--            <form method="post" action="{{ route('storeTeacherAnswer', $studentAnswerId) }}">--}}
{{--                @csrf--}}
{{--                <div class="form-group">--}}
{{--                    <p class="text-secondary h4">Adaugă răspunsul tău:</p>--}}
{{--                    <textarea class="form-control" name="answer" rows="6">{{$studentAnswer->answer}}</textarea>--}}


{{--                    <label for="points">Points:</label>--}}
{{--                    <input type="number" class="form-control" name="points" value="{{old('points')}}">--}}
{{--                </div>--}}


{{--                <button type="submit" class="btn btn-success">Add T answer</button>--}}
{{--            </form>--}}
        </div>
    </div>
    </div>


{{--            <br>--}}
{{--            <br>--}}


{{--            <div class="container">--}}

{{--                <br>--}}
{{--                <div class="row">--}}

{{--                                        {{$question->subject->subject}}--}}

{{--                                            <b>{{ $question->question }}</b>--}}



{{--                                        --}}
{{--                                        <span class="badge badge-pill badge-secondary">Punctaj--}}
{{--                                            maxim: {{$question->max_points}}--}}
{{--                                        </span>--}}
{{--                                    </div>--}}



{{--        </div>--}}



    <div>
    </div>
@endsection

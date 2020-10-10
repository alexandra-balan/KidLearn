@extends('base')
@extends('layouts.app')
@section('main')
    <div>@if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12">

            <h1 class="display-3">Exercitii</h1>


            <br>
            <br>


            <div class="container">
                <form method="GET" action="{{route('questions.index')}}" >
                    {{ csrf_field() }}
                    <div class="form-group form-row justify-content-lg-start">
                        <span style="margin-left: 1em;"></span>
                        <select class="form-control col-sm-3" name="filter">
                            <option value="">--Filtrează--</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject}}</option>
                            @endforeach
                        </select>
                        <span style="margin-left: 3em;"></span>
                        <select class="form-control col-sm-3" name="sorter">
                            <option value="">--Sortează--</option>
                            <option value="descScor">Cel mai mare punctaj</option>
                            <option value="ascScor">Cel mai mic punctaj</option>
                        </select>
                        <span style="margin-left: 2em;"></span>
                        <button type="submit" class="btn btn-primary">Aplică</button>

                    </div>
                </form>
                <br>
                <div class="row">
                    @foreach($questions as $question)
                        <div class="col-sm-4">
                            <div class="card-deck">
                                <div class="card border-secondary mb-3" style="max-width: 20rem;">
                                    <div class="card-header">
                                        {{$question->subject->subject}}
                                    </div>

                                    <div class="card-body" style="height: 7rem;">


                                        {{--                                        <h5 class="card-title">--}}
                                        {{--                                            <b>{{$question->max_points}}</b>--}}
                                        {{--                                        </h5>--}}
                                        <p class="card-text"
                                           style="
                                           display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            overflow:hidden;
                                            text-overflow: ellipsis;
                                          ">
                                            <b>{{ $question->question }}</b>
                                        </p>
                                    </div>


                                    <div class="card-footer text-muted ">
                                        <a href="{{route('questions.show', $question->id)}}" class="card-link">Citește mai mult</a>
                                        @if(Auth::user()->role == 'Elev' )
                                        <a href="{{route('createStudentAnswer', $question->id)}}" class="card-link">Răspunde</a>
                                        @endif
                                        <span class="badge badge-pill badge-secondary">Punctaj
                                            maxim: {{$question->max_points}}
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    {{--            </div>--}}
    {{--            <div class="card-deck">--}}
    {{--            <table class="table table-hover">--}}
    {{--                <thead>--}}
    {{--                <tr class="table-primary">--}}
    {{--                    <td>ID</td>--}}
    {{--                    <td>Enunț</td>--}}
    {{--                    <td>Materie</td>--}}
    {{--                                        <td colspan=4></td>--}}
    {{--                </tr>--}}
    {{--                </thead>--}}
    {{--                <tbody>--}}
    {{--                @foreach($questions as $question)--}}
    {{--                    <tr class="table-active">--}}
    {{--<td>--}}
    {{--                        <div class="card border-info mb-3" style="max-width: 20rem;">--}}
    {{--                            <div class="card-header">Header</div>--}}
    {{--                            <div class="card-body">--}}
    {{--                                <h4 class="card-title">Info card title</h4>--}}
    {{--                                <p class="card-text">{{$question->question}} </p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--</td>--}}
    {{--                        <td>{{$question->id}}</td>--}}
    {{--                        <td>{{$question->question}} </td>--}}
    {{--                        <td>{{$question->subject->subject}} </td>--}}
    {{--                        <td>--}}
    {{--                            <a href="{{ route('createStudentAnswer', $question->id)}}" class="btn btn-primary">Adaugă un răspuns</a>--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                @endforeach--}}
    {{--                </tbody>--}}
    {{--            </table>--}}

    {{--            <div class="card-deck">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <h5 class="card-title">Card title</h5>--}}
    {{--                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
    {{--                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <h5 class="card-title">Card title</h5>--}}
    {{--                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>--}}
    {{--                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <h5 class="card-title">Card title</h5>--}}
    {{--                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>--}}
    {{--                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    <br> <br>
    {!!  $questions->appends(['sorter' => $sorter, 'filter' => $filter])->render() !!}
    <br>
    @if(Auth::user()->role == 'Profesor')
    <td>
        <a href="{{ route('questions.create')}}" class="btn btn-primary">Adaugă o întrebare</a>
    </td>
@endif
    <div>
    </div>
@endsection

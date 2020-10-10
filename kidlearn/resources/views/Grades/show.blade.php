@extends('base')
@extends('layouts.app')
@section('main')

    <div class="row">

        <div class="col-sm-12">
            <h1 class="display-3">{{$name}}</h1>
            <h2 class="display-6">Note</h2>

            <span class="badge badge-pill badge-secondary "> <h5> Media ta generală este {{$medie}}
            </h5>  </span>
            <br> <br>
            <div class="container">
                <form method="GET"  action="{{route('grades.show', $id)}}">
                    {{ csrf_field() }}
                    <div class="form-group form-row justify-content-lg-start">
                        <span style="margin-left: 1em;"> </span>

                    <select class="form-control col-sm-3" name="sorter">
                        <option value="" selected disabled hidden>--Sortează--</option>
                        <option value="Ascendent">Crescator</option>
                        <option value="Descendent">Descrescator</option>
                    </select>
                    <span style="margin-left: 3em;"></span>
                    <select class="form-control col-sm-3" name="filter">
                        <option value="" selected disabled hidden>--Filtrează--</option>
                        @foreach($uniqueSubjects as $subject)
                            <option value="{{$subject}}">{{$subject}}</option>
                        @endforeach
                    </select>
                    <span style="margin-left: 2em;"></span>
                    <button type="submit" class="btn btn-primary">Aplică</button>

                    </div>
                </form>
            </div>

            <br>

            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Notă</td>
                    <td>Semestru</td>
                    <td>Comentariu</td>
                    <td>Materie</td>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr class="table-active">
                        <td>{{$student->grade}}</td>
                        <td>{{$student->semester}}</td>
                        <td>{{$student->comment}}</td>
                        <td>{{$student->subject}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>


            {{--            {{$students->links()}}--}}
            {{--            --}}{{--            @if(Auth::check())--}}
            {{--            <td>--}}

            {{--                <form method="get" action="{{route('addComment', $student->id)}}">--}}
            {{--                                            <input type="hidden" name="class_id" value="{{$student->class_id}}">--}}
            {{--                    <a href="{{ route('addGrade',$student->id)}}" class="btn btn-primary">Add grade</a>--}}
            {{--                </form>--}}
            {{--            </td>--}}
            {{--            --}}{{--            @endif--}}



            {!! $students->appends(['sorter' => $sorter, 'filter' => $filter])->render() !!}

        </div>
    </div>
@endsection

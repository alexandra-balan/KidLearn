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

            <h1 class="display-3">Elevi</h1>

            <form method="GET"  action="{{route('students.index')}}" class="row">
                {{ csrf_field() }}
                <div class="form-group col-sm-3">

                    <select class="form-control" name="filter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="AscendentNume">A-Z</option>
                        <option value="DescendentNume">Z-A</option>
                        <option value="AscendentScor">Cel mai mic punctaj</option>
                        <option value="DescendentScor">Cel mai mare punctaj</option>
                    </select>
                </div>
                <button type="submit" onsubmit="sorting()" class="btn btn-primary">Sortează</button>
            </form>
<br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Nume</td>
                    <td>Clasa</td>
                    <td>Scor</td>
                    <td colspan=4></td>
                </tr>
                </thead>
                <tbody>
                <div class="container">


                @foreach($students as $student)
                    @if(Auth::user()->role == 'Elev' )
{{--                    && $student->user_id == Auth::user()->id--}}

                        <tr class="table-active">
                            <td>{{$student->name}} </td>

                            <td>{{$student->classes->year}} {{$student->classes->label}} </td>
                            <td>{{$student->score}} </td>
                            @if(Auth::user()->id == $student->user_id)
                            <td>
                                <a href="{{ route('students.show',$student->id)}}" class="btn btn-primary">Detalii</a>
                            </td>
                                @else <td></td>
                                @endif
                        </tr>
                    @endif
                    @if(Auth::user()->role == 'Profesor')
                        <tr class="table-active">
                            <td>{{$student->name}} </td>
                            <td>{{$student->classes->year}} {{$student->classes->label}} </td>
                            <td>{{$student->score}} </td>
                            <td>
                                <a href="{{ route('students.show',$student->id)}}" class="btn btn-primary">Detalii</a>
                            </td>
                            <td>
                                <form method="get" action="{{route('createGrade', $student->id)}}">
                                    <input type="hidden" name="class_id" value="{{$student->class_id}}">
                                    <a href="{{ route('createGrade',$student->id)}}" class="btn btn-primary">
                                        Adaugă notă
                                    </a>
                                </form>
                            </td>
                        </tr>
                            @endif

                        @endforeach
                </div>

                </tbody>
            </table>
            @if(Auth::user()->role == 'Profesor')
            <form method="get" action="{{route('students.create')}}">
                <a href="{{ route('students.create')}}" class="btn btn-primary">
                    Adaugă un nou elev
                </a>
            </form>
            @endif
{{--@php--}}

{{--@endphp--}}

            {!! $students->appends(['filter' => $filter])->render() !!}
            <div>
            </div>
@endsection

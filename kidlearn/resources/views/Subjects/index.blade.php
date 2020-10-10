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

            <h1 class="display-3">Materii</h1>

            <form method="GET"  action="{{route('subjects.index')}}" class="row">
                {{ csrf_field() }}
                <div class="form-group col-sm-3">

                    <select class="form-control" name="sorter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="AscendentNume">A-Z</option>
                        <option value="DescendentNume">Z-A</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sortează</button>
            </form>
            <br>

            <table class="table table-hover">
                <thead>

                <tr class="table-primary">
                    <td>Materie</td>
                    <td>Profesor</td>
                    <td>Clasă</td>
                    <td colspan="2"></td>
                </tr>

                </thead>
                <tbody>
                <div class="container">
                    @foreach($subjects as $subject)
                        @foreach($subject->studentClasses as $class)
                        <tr class="table-active">
                                <td>{{$subject->subject}} </td>
                                <td>{{$subject->teacher->name}}</td>
                                <td>{{$class->year}}{{$class->label}}</td>

                            <td>
                                <form action="{{ route('subjects.destroy', $subject->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-primary" type="submit">Șterge</button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </div>

                </tbody>
            </table>
            <br>
            @if(Auth::user()->role == 'Profesor')
            <form method="get" action="{{route('subjects.create')}}">
                <a href="{{ route('subjects.create')}}" class="btn btn-primary">
                    Adaugă o nouă materie
                </a>
            </form>
            @endif
            {!! $subjects->appends(['sorter' => $sorter])->render() !!}
            <div>
            </div>
@endsection

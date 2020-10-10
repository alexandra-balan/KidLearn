@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Clase</h1>
            <form method="GET"  action="{{route('studentClasses.index')}}" class="row">
                {{ csrf_field() }}
                <div class="form-group col-sm-3">

                    <select class="form-control" name="sorter">
                        <option value="" selected disabled hidden>Alege aici</option>
                        <option value="Ascendent">A-Z</option>
                        <option value="Descendent">Z-A</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Sortează</button>
            </form>
            <br>
            <table class="table table-striped">
                <thead>
                <tr class="table-primary">

                    <td>Clasă</td>


                    <td colspan = 4></td>
                </tr>
                </thead>
                <tbody>
                @foreach($classes as $class)
                    <tr>

                        <td>{{$class->year}}{{$class->label}} </td>

                        <td>
                            <a href="{{ route('semiAnnualReport', $class->id)}}" class="btn btn-secondary">Raport semestrial</a>
                        </td>
                        <td>
                            <a href="{{ route('annualReport', $class->id)}}" class="btn btn-secondary">Raport anual</a>
                        </td>
                        <td>
                            <a href="{{ route('graduationRate',$class->id)}}" class="btn btn-secondary">Rata de absolvire</a>
                        </td>
                        @if(Auth::user()->role == 'Profesor')
                        <td>

                            <form action="{{ route('studentClasses.destroy',$class->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">Șterge
                                </button>
                            </form>
                        </td>
@endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if(Auth::user()->role == 'Profesor')
            <form method="get" action="{{route('studentClasses.create')}}">
                <a href="{{ route('studentClasses.create')}}" class="btn btn-primary">
                    Adaugă o nouă clasă
                </a>
            </form>
            @endif
            {!!  $classes->appends(['sorter' => $sorter])->render() !!}
            </div>
            </div>
@endsection

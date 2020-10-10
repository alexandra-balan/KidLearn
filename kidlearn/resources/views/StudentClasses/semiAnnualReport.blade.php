@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Raport semestrial</h1>
            <br> <br>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>An</td>
                    <td>Serie</td>
                    <td>Nume</td>
                    <td>Medie sem. 1</td>
                    <td>Medie sem. 2</td>


                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>

                        <td>{{$report['year']}} </td>
                        <td>{{$report['label']}}</td>
                        <td>{{$report['name']}}</td>
                        <td>{{$report['avg1']}}</td>
                        <td>{{$report['avg2']}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

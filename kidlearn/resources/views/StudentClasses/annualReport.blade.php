@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Raport anual</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>An</td>
                    <td>Serie</td>
                    <td>Nume</td>
                    <td>Medie </td>



                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>

                        <td>{{$report['year']}} </td>
                        <td>{{$report['label']}}</td>
                        <td>{{$report['name']}}</td>
                        <td>{{$report['avg']}}</td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

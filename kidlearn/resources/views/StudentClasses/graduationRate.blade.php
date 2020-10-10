@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Rata de absolvire</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>An</td>
                    <td>Serie</td>
                    <td>Rata de absolvire a clasei</td>
                    <td>Rata de absolvire a scolii </td>



                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>

                        <td>{{$report['year']}} </td>
                        <td>{{$report['label']}}</td>
                        <td>{{$report['classGR']}}%</td>
                        <td>{{$report['totalGR']}}%</td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

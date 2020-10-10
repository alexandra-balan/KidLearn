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

            <h1 class="display-3">Raspunsurile corectate</h1>
            <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    {{--                    <td>ID</td>--}}
                    {{--                    <td>Question id</td>--}}
{{--                    <td>Răspunsul elevului</td>--}}
                    <td>Răspunsul corectat</td>
                    <td>Materie</td>
                    <td>Elev</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr class="table-active">
                        <td>
                            <p
                               style="
                                           display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            overflow:hidden;
                                            text-overflow: ellipsis;
                                          ">
                                {{$answer->teacherAnswer}}
                            </p></td>
                        <td>{{$answer->subject}} </td>
                        <td>{{$answer->name}} </td>
                        <td>
                        <form method="get" action="{{route('difference.show', $answer->tId)}}">
                            <a href="{{ route('difference.show', $answer->tId)}}" class="btn btn-primary">Vezi diferențele
                            </a>
                        </form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $answers->render() !!}
            <div>
            </div>
@endsection

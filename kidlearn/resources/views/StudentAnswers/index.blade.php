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

            <h1 class="display-3">Raspunsurile elevilor</h1>
            <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
{{--                    <td>ID</td>--}}
{{--                    <td>Question id</td>--}}
                    <td>Răspuns</td>
                    <td>Materie</td>
                    <td>Elev</td>
                                        <td colspan=4></td>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr class="table-active">
{{--                        <td>{{$answer->id}}</td>--}}
{{--                        <td>{{$answer->question_id}} </td>--}}
                        <td>
                            <p class="card-text"
                               style="
                                           display: -webkit-box;
                                            -webkit-line-clamp: 3;
                                            -webkit-box-orient: vertical;
                                            overflow:hidden;
                                            text-overflow: ellipsis;
                                          ">
                               {{$answer->answer}}
                            </p></td>
                        <td>{{$answer->subject}} </td>
                        <td>{{$answer->name}} </td>
                        @if(Auth::user()->role == 'Profesor')
                        <td>
                            <a href="{{ route('createTeacherAnswer', $answer->answerId)}}" class="btn btn-primary">Corectează acest răspuns</a>
                        </td>
                            @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $answers->render() !!}
            <div>
            </div>
@endsection

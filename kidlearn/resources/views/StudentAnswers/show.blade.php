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

            <h1 class="display-3">Raspunsurile tale</h1>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    {{--                    <td>ID</td>--}}
                    {{--                    <td>Question id</td>--}}
                    <td>Răspuns</td>
                                        <td>Puncte obtinute </td>
                    <td colspan=4></td>
                </tr>
                </thead>
                <tbody>
                @foreach($studentAnswers as $answer)
                    <tr class="table-active">
{{--                        <td>--}}
{{--                            <p style="max-width: 20rem;--}}
{{--                                      overflow: hidden;--}}
{{--                                      white-space: nowrap;--}}
{{--                                      text-overflow: ellipsis;">--}}
{{--                                {{$answer}}--}}
{{--                            </p>--}}
{{--                        </td>--}}
                        <td>
                            <p style="width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                {{$answer['answer']}}
                            </p>
                        </td>
                        @if($answer['teacher_answers']['points'] >= 0.00)
                            <td>{{$answer['teacher_answers']['points']}}</td>
                            <td>
                                <form method="get" action="{{route('difference.show', $answer['teacher_answers']['id'])}}">
                                    <a href="{{ route('difference.show', $answer['teacher_answers']['id'])}}" class="btn btn-primary">Vezi diferențele
                                    </a>
                                </form>
                            </td>

                        @else
                            <td>0</td>

                            <td> Încă nu a fost corectat</td>

                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
            </div>
@endsection

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
            <a href="{{ route('grades.show', $id)}}" class="btn btn-primary">Vezi toate notele </a>

                {{--            {{$students->links()}}--}}
            {{--            --}}{{--            @if(Auth::check())--}}
            {{--            <td>--}}

            {{--                <form method="get" action="{{route('addComment', $student->id)}}">--}}
            {{--                                            <input type="hidden" name="class_id" value="{{$student->class_id}}">--}}
            {{--                    <a href="{{ route('addGrade',$student->id)}}" class="btn btn-primary">Add grade</a>--}}
            {{--                </form>--}}
            {{--            </td>--}}
            {{--            --}}{{--            @endif--}}


            <br> <br>
            <br> <br>
            <h2 class="display-5">Punctaje obtinute</h2>
            <span class="badge badge-pill badge-secondary"><h5>Scorul tău total este de {{$punctaj}} de puncte
                </h5> </span>
            <br> <br>
            <table class="table table-hover">
                <thead>
                <tr class="table-primary">
                    <td>Întrebare</td>
                    <td>Răspunsul tău</td>
                    <td>Punctaj obținut</td>
                    <td>Status</td>

                </tr>
                </thead>
                <tbody>
                @foreach($answers as $answer)
                    <tr class="table-active">
                        <td>
                            <p style="max-width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                {{$answer->question->question}}
                            </p>
                        </td>
                        <td>
                            <p style="width: 20rem;
                                      overflow: hidden;
                                      white-space: nowrap;
                                      text-overflow: ellipsis;">
                                {{$answer->answer}}
                            </p>
                        </td>
                        @if($answer->teacherAnswers['points'])
                            <td>{{$answer->teacherAnswers['points']}}</td>
                        <td>
                            <form method="get" action="{{route('difference.show', $answer->teacherAnswers['id'])}}">
                                <a href="{{ route('difference.show', $answer->teacherAnswers['id'])}}" class="btn btn-primary">Vezi diferențele
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
{{--            {{$answers->links()}}--}}
            <a href="{{route('studentAnswers.show', $id)}}" class="btn btn-primary">Vezi toate răspunsurile </a>

        </div>
    </div>
@endsection

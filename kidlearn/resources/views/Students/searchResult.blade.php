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


            <br>


 @if(count($students))

                        <table class="table table-hover">
                            <thead>
                            <tr class="table-primary">
                                <td>Elevi</td>
                                <td>Scor</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="container">
                        @foreach($students as $student)
                            <tr class="table-active">
                                <td>{{$student->name}} </td>
                                <td>{{$student->score}} </td>
                                @if(Auth::user()->id == $student->user_id || Auth::user()->role == 'Profesor')
                                    <td>
                                        <a href="{{ route('students.show',$student->id)}}" class="btn btn-primary">Detalii</a>
                                    </td>
                                    @endif
                            </tr>
                            @endforeach
     @endif


     @if(count($questions))
                 <table class="table table-hover">
                     <thead>
                     <tr class="table-primary">
                         <td>Intrebari</td>
                         <td colspan="2"></td>
                     </tr>
                     </thead>
                     <tbody>
                     <div class="container">
         @foreach($questions as $question)
             <tr class="table-active">
                 <td>{{substr($question->question, 0,150)}} </td>
                 <td>        <a href="{{route('questions.show', $question->id)}}" class="card-link">Citește mai mult</a>
                 </td>
             </tr>
         @endforeach
     @endif



            <div>
            </div>
@endsection

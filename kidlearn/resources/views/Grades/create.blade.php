@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adauga o nota</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif
                <br><br>


                       <span class="badge badge-pill badge-secondary "><h5>
                              {{$studentName}}
                           </h5></span>
                    <br><br>
                <form method="post" action="{{ route('storeGrade', $student_id)}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">

                        <label for="grade"><h5><strong> Nota :</strong> </h5></label>
                        <select name="grade" class="form-control">
                            <option value="" selected disabled hidden>Alege o notă</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                            <option value='3'>3</option>
                            <option value='4'>4</option>
                            <option value='5'>5</option>
                            <option value='6'>6</option>
                            <option value='7'>7</option>
                            <option value='8'>8</option>
                            <option value='9'>9</option>
                            <option value='10'>10</option>
                        </select>


                        <label for="subject">Materia :</label>
                        <select  name="subject" class="form-control">
                            <option type="text" value="" selected disabled hidden>Alege aici</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject}}">{{$subject}}</option>

                            @endforeach
                        </select>

                        <label for="semester">Semestru:</label>
                        <select name="semester" class="form-control">
                            <option value="" selected disabled hidden>Alege aici</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>

                        <label for="subject">Comentariu :</label>
                        <input type="text" class="form-control" name="comment" value="{{old('comment')}}"/>
{{--                        <input type="hidden" name="class_id" value="{{$class_id}}">--}}
                    </div>


                    <button type="submit" class="btn btn-primary justify-content-between align-content-center">Adaugă nota</button>
                </form>
            </div>
        </div>
    </div>
@endsection

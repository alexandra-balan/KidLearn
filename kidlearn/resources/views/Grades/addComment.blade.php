@extends('base')
@extends('layouts.app')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add comment</h1>
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
                    @if(Auth::user()->role == 'Profesor')
                <form method="post" action="{{ route('storeComment', $grade_id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="subject">Comment :</label>
                        <input type="text" class="form-control" name="comment" value="{{old('comment')}}"/>

                    </div>


                    <button type="submit" class="btn btn-success">Add comment</button>
                </form>
                        @endif
            </div>
        </div>
    </div>
@endsection

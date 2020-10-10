@extends('base')

@extends('layouts.app')
@section('main')

<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Adauga o noua clasa</h1>
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('studentClasses.store') }}">
                @csrf
                <div class="form-group">
                    <label for="year">An</label>
                    <select class="form-control" name="year">
                        <option value="" selected disabled hidden>Alege aici</option>
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
                        <option value='11'>11</option>
                        <option value='12'>12</option>

                    </select>

                </div>

                <div class="form-group">
                    <label for="label">Serie</label>
                    <input type="text" class="form-control" name="label"/>
                </div>

                <button type="submit" class="btn btn-primary">Adaugă clasa</button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('base')
@extends('layouts.app')
@section('main')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/diff.css') }}">
    <div class="card-deck">
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Raspunsul elevului</div>
            <div class="card-body">
                <h4 class="card-title"></h4>

                <p class="card-text">{!!html_entity_decode($studentAnswerNew, ENT_COMPAT)!!}</p>
            </div>
        </div>
        <span></span>
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Raspunsul profesorului</div>
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text">{!! $teacherAnswerNew !!}</p>
            </div>
        </div>
        <div class="card border-primary mb-3" style="max-width: 20rem;">
            <div class="card-header">Diferențe</div>
            <div class="card-body">
                <h4 class="card-title"></h4>
                <p class="card-text">{!! $content !!}</p>
            </div>
        </div>
    </div>


@endsection

@extends('layouts.app')

@section('title', 'Try The Boss')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container">
    <div class="row">
        <div class="col-7">
            <form method="POST" action="#">
                @csrf
                @foreach ($boss->questions as $question)
                <h3>{{ $question->question_text }}</h3>
                    @foreach ($question->options as $option)
                        <label>
                            <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}">
                            {{ $option->option_text }}
                        </label>
                    @endforeach
                @endforeach
                <button type="submit" class="mgt-btn">Create</button>
            </form>

        </div>
    </div>
</div>
@endsection

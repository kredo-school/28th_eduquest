@extends('layouts.app')

@section('title', 'News')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">News</h1>
    <hr>
    @foreach($newsItems as $news)
        <div class="news-item" style="border-bottom: 1px solid #ccc; padding: 10px 0;">
            <span class="badge" style="background-color: #ffeb3b; color: #000; padding: 5px;">{{ $news->title }}</span>
            <h2 style="display: inline; margin-left: 10px;">{{ $news->content }}</h2>
            <p style="margin-top: 5px; font-size: 0.9em; color: #555;">date: {{ $news->updated_at }}</p>
        </div>
    @endforeach
</div>
@endsection 
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $quest->quest_title }} - チャプター一覧</h2>
    
    <div class="chapters-list">
        @foreach($chapters as $chapter)
            <div class="chapter-item">
                <h3>{{ $chapter->title }}</h3>
                <p>{{ $chapter->description }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection 
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>クエスト一覧</h2>
    
    <div class="quest-list">
        @foreach($quests as $quest)
            <div class="quest-item">
                <h3>{{ $quest->quest_title }}</h3>
                <p>{{ $quest->description }}</p>
                
                {{-- チャプター一覧へのリンクを修正 --}}
                <a href="{{ route('quests.chapters', $quest) }}" class="btn btn-primary">
                    チャプター一覧
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection 
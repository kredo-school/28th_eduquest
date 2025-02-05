@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $quest->quest_title }} - チャプター一覧</h2>
    
    <div class="chapters-list">
        @forelse($chapters as $chapter)
            <div class="chapter-item">
                <h3>{{ $chapter->title }}</h3>
                <p>{{ $chapter->description }}</p>
            </div>
        @empty
            <p>チャプターがまだありません。</p>
        @endforelse
    </div>

    <div class="mt-3">
        <a href="{{ route('quests.show', $quest) }}" class="btn btn-secondary">
            クエスト詳細に戻る
        </a>
    </div>
</div>
@endsection 
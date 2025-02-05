@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $quest->quest_title }}</h2>
    
    <!-- クエストの詳細情報 -->
    
    <!-- チャプター一覧へのリンク -->
    <div class="mt-3">
        <a href="{{ route('quests.chapters', $quest) }}" class="btn btn-primary">
            チャプター一覧を見る
        </a>
    </div>
</div>
@endsection 
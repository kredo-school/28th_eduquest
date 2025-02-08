{{-- resources/views/players/quests/searchresult.blade.php --}}
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<style>
.horizontal-scroll {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 1rem;
}

.quest-card {
    flex: 0 0 auto; 
    width: 220px; 
    border: 1px solid #ccc;
    border-radius: 5px;
    background: #fff;
}

.quest-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}
.creator-info {
    display: flex;
    align-items: center;
    margin-top: 8px;
}
.creator-info img {
    width: 32px;
    height: 32px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 8px;
}
</style>

<div class="container">

    <h1 class="mb-4">
        Search Results
        @php
            // どのようなフォーマットで表示するか
            // 例: - "カテゴリー名 / 検索ワード"
        @endphp
        @if($categoryName && $searchWord)
           - "{{ $categoryName }} / {{ $searchWord }}"
        @elseif($categoryName)
           - "{{ $categoryName }}"
        @elseif($searchWord)
           - "{{ $searchWord }}"
        @endif
    </h1>

    @if($quests->isEmpty())
        <p>No quests found.</p>
    @else
        <!-- 横スクロールで表示 -->
        <div class="horizontal-scroll">
            @foreach($quests as $quest)
                <div class="quest-card p-2">
                    
                    <!-- サムネイル -->
                    <img src="{{ $quest->thumbnail }}" alt="Thumbnail">

                    <!-- タイトル -->
                    <h5 class="mt-2 mb-1">{{ $quest->quest_title }}</h5>

                    <!-- Creatorアイコン + 名前 -->
                    @if($quest->creator)
                        <div class="creator-info">
                            @if($quest->creator->creator_image)
                                <img src="{{ $quest->creator->creator_image }}" alt="Creator Icon">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                            <span>{{ $quest->creator->creator_name }}</span>
                        </div>
                    @else
                        <div class="creator-info">
                            <i class="fas fa-user"></i>
                            <span>Unknown Creator</span>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

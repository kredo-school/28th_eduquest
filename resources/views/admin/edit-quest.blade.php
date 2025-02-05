@extends('layouts.app')

@section('content')
<div class="container">
    <h2>クエスト編集</h2>
    
    {{-- クエストの基本情報編集フォーム --}}
    <form action="{{ route('quests.update', ['quest' => $quest->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- フォームの内容 -->
    </form>

    {{-- チャプター一覧へのリンク --}}
    <div class="mt-4">
        <a href="{{ route('quests.chapters', ['quest' => $quest->id]) }}" class="btn btn-primary">
            チャプター一覧を表示
        </a>
    </div>
</div>
@endsection 
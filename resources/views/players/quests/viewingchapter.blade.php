@extends('layouts.app')
@section('title', 'Player viewingchapter')
@section('content')
<div class="container">
    <div class="w-100" >
        <div class="video-player text-center">
            <iframe width="85%" height="400px" src="{{ $chapter->video }}" frameborder="0" allowfullscreen></iframe>
        </div>
    
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="d-flex align-items-center gap-3 mt-3">
                <h2 class="m-0 mb-1">{{ $chapter->quest_chapter_title }}</h2>
                <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}" id="go-chapterlist-btn" 
                    class="btn btn-sm border rounded bg-white"
                    style="color: #261C11; border-color: #261C11 !important; border-radius: 15px !important; 
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); padding: 4px 10px; font-size: 0.85rem;">
                    Chapterlist <img src="{{ asset('images/yajirushi_right.png') }}" alt="矢印" style="width: 15px; height: 15px;">
                </a>
            </div>

            <div class="d-flex align-items-center">
                @if ($prevChapter)
                    <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $prevChapter->id]) }}" class="btn">
                        <img src="{{ asset('images/tatefuda_yajirushi_01_beige 2左向き.png') }}" alt="矢印" class="mx-0" style="width: 23px; height: 23px;">
                    </a>
                @endif

                @if($userQuest)
                    <button class="complete-chapter-btn btn border rounded bg-white text-center mx-1"
                            data-chapter-id="{{ $chapter->id }}" data-status="{{ $userQuest->status }}"
                        @if($isLastChapter)
                            data-bs-toggle="modal" data-bs-target="#reviewsModal"
                        @endif
                            style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                        @if($isLastChapter)
                            Complete
                        @else
                            <img src="{{ asset('images/jewelry_pyramid_lightblue 1.png') }}" alt="矢印" class="mx-auto" style="width: 18px; height: 18px;">
                        @endif
                    </button>
                @else
                @endif


                @include('players.modals.reviews')
        
                @if ($nextChapter)
                    <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $nextChapter->id]) }}" class="btn">
                        <img src="{{ asset('images/tatefuda_yajirushi_01_beige 2.png') }}" alt="矢印" style="width: 23px; height: 23px;">
                    </a>
                @endif
            </div>
        </div>
        <p class="mt-2">{{ $chapter->description }}</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chapterId = "{{ $chapter->id }}";
        const questId = "{{ $quest->id }}";
        const userId = "{{ auth()->id() }}";
        const storageKey = "completed_chapters_" + userId + "_" + questId;
        const completedChapters = JSON.parse(localStorage.getItem(storageKey) || "[]");
        const status = "{{ $userQuest ? $userQuest->status : 'null' }}";

        // ステータスが2の場合はボタンを無効化
        if (status == 2 || completedChapters.includes(chapterId)) {
            const button = document.querySelector('.complete-chapter-btn[data-chapter-id="' + chapterId + '"]');
            button.innerHTML = `
                <img src="{{ asset('images/jewelry_round_yellow.png') }}" alt="jewelry" class="mx-auto" style="width: 18px; height: 18px;">`;
            button.disabled = true;  
        }

        // ボタンクリック時の処理
        document.querySelectorAll('.complete-chapter-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                if (completedChapters.includes(chapterId) || status == 2) return;  // 完了状態またはステータスが2なら何もしない

                // 完了状態をlocalStorageに保存
                completedChapters.push(chapterId);
                localStorage.setItem(storageKey, JSON.stringify(completedChapters));

                // 完了状態に変更
                this.innerHTML = `
                    <img src="{{ asset('images/jewelry_round_yellow.png') }}" alt="jewelry" class="mx-auto" style="width: 18px; height: 18px;">`;
                this.disabled = true;  // ボタンを無効化

                // 最後のチャプターの場合にステータス変更APIを呼び出す
                if (this.hasAttribute('data-bs-toggle')) {
                    fetch("{{ route('quest.complete') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ quest_id: questId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("クエスト完了: ステータスが 2 に更新されました");
                        } else {
                            console.error("クエスト完了エラー");
                        }
                    })
                    .catch(error => console.error("通信エラー", error));

                    $('#reviewsModal').modal('show');
                }
            });
        });
    });
</script>
@endsection




    
    

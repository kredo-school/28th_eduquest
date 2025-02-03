@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="video-player text-center">
            <iframe width="85%" height="400px" src="{{ $chapter->video }}" frameborder="0" allowfullscreen></iframe>
        </div>
    
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h2 class="m-0">{{ $chapter->quest_chapter_title }}</h2>
            <div class="d-flex align-items-center">
                @if ($prevChapter)
                    <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $prevChapter->id]) }}" class="btn">
                        <img src="{{ asset('images/tatefuda_yajirushi_01_beige 2左向き.png') }}" alt="矢印" style="width: 23px; height: 23px;">
                    </a>
                @endif
        
                <button id="complete-btn" class="btn border rounded px-3 py-2 bg-white"
                    style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"
                    @if(!$isLastChapter) disabled @endif
                    data-bs-toggle="modal" data-bs-target="#reviewsModal">
                    Complete
                </button>


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
<div class="container mt-5">
    <h4>Other Chapters</h4>
    <div class="row">
        @foreach ($otherChapters as $other)
            <div class="col-md-4 mb-3">
                <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $other->id]) }}" class="text-decoration-none">
                    <div class="card">
                        <img src="{{ $other->thumbnail }}" class="card-img-top" alt="チャプターサムネイル">
                        <div class="card-body">
                            <h5 class="card-title">{{ $other->quest_chapter_title }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<script>
document.getElementById("complete-btn").addEventListener("click", function() {
    fetch("{{ route('chapter.complete', $chapter->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({})
    }).then(response => response.json()).then(data => {
        if (data.last) {
            $('#reviewsModal').modal('show');
        }
    });
});
</script>


@endsection


    {{-- <script>
document.addEventListener('DOMContentLoaded', function () {
    var video = document.querySelector('video'); // <video> タグがある場合
    var completeBtn = document.getElementById('complete-btn');

    if (video) {
        video.addEventListener('ended', function () {
            completeBtn.removeAttribute('disabled'); // 再生終了時にボタンを有効化
        });
    }
});
</script> --}}
    
    

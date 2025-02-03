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
                    <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $prevChapter->id]) }}" class="btn btn-secondary me-2"><img src="{{ asset('images/image 83.png') }}" alt="treasure box" class="me-2"
                        style="width: 23px; height: 23px;"></a>
                @else
                    <span class="btn btn-secondary disabled me-2"><img src="{{ asset('images/tatefuda_yajirushi_01_beige 2左向き.png') }}" alt="矢印" class="me-2"
                        style="width: 23px; height: 23px;"></span>
                @endif

                <button id="complete-btn" class="btn border rounded px-3 py-2 bg-white me-2"
                    style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                           box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                    <img src="{{ asset('images/image 83.png') }}" alt="treasure box" class="me-2"
                         style="width: 23px; height: 23px;">
                    Complete
                </button>
    
                @if ($nextChapter)
                    <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $nextChapter->id]) }}" class="btn btn-secondary"><img src="{{ asset('images/next.png') }}" alt="treasure box" class="me-2"
                        style="width: 23px; height: 23px;"></a>
                @else
                    <span class="btn btn-secondary disabled"><img src="{{ asset('images/tatefuda_yajirushi_01_beige 2.png') }}" alt="矢印" class="me-2"
                        style="width: 23px; height: 23px;"></span>
                @endif
            </div>
        </div>
    
        <p class="mt-2">{{ $chapter->description }}</p>
    </div>
    
</div>
    
<!-- レビューモーダル -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Congratulations!!</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="review-form">
                    <div class="rating">
                        <input type="radio" name="rating" value="5"> ★★★★★
                        <input type="radio" name="rating" value="4"> ★★★★☆
                        <input type="radio" name="rating" value="3"> ★★★☆☆
                        <input type="radio" name="rating" value="2"> ★★☆☆☆
                        <input type="radio" name="rating" value="1"> ★☆☆☆☆
                    </div>
                    <textarea name="review" class="form-control" placeholder="Write your review..."></textarea>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
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
            $('#reviewModal').modal('show');
        }
    });
});
</script>

{{--レビューのJS--JS--}}
{{-- <script>
    document.getElementById("review-form").addEventListener("submit", function(event) {
        event.preventDefault();
    
        let formData = new FormData(this);
        formData.append("quest_id", "{{ $chapter->quest->id }}");
    
        fetch("{{ route('reviews.store') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: formData
        }).then(response => response.json()).then(data => {
            if (data.success) {
                alert("Review submitted successfully!");
                $('#reviewModal').modal('hide');
            }
        });
    });
    </script> --}}
    

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="video-player text-center">
        <iframe width="85%" height="400px" src="{{ $chapter->video }}" frameborder="0" allowfullscreen></iframe>
    </div>

    <h2>{{ $chapter->quest_chapter_title }}</h2>
    <p>{{ $chapter->description }}</p>

    <button id="complete-btn" class="btn btn-primary">Complete</button>

    <div class="nav-buttons">
        @if ($prevChapter)
            <a href="{{ route('chapter.show', $prevChapter->id) }}" class="btn btn-secondary">← Previous</a>
        @else
            <span class="btn btn-secondary disabled">← Previous</span>
        @endif
        @if ($nextChapter)
            <a href="{{ route('chapter.show', $nextChapter->id) }}" class="btn btn-secondary">Next →</a>
        @else
            <span class="btn btn-secondary disabled">Next →</span>
        @endif
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
<script>
    document.getElementById("review-form").addEventListener("submit", function(event) {
        event.preventDefault();
    
        let formData = new FormData(this);
        formData.append("quest_id", "{{ $chapter->quest->id }}");
    
        fetch("{{ route('review.store') }}", {
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
    </script>
    

@endsection

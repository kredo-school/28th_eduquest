@extends('layouts.app')

@section('title', 'Create The Boss')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
@php
    use App\Models\Badge;
    $badges = Badge::all(); // Blade 側でバッジデータを取得
@endphp
<div class="container">
    
    <div class="row">
        <div class="col-7">
            <h2 class="mb-4">
                Create Boss for "{{ $quest->quest_title}}"
            </h2>
            <form method="POST" action="{{ route('quests.bosses.store', ['quest_id' => $quest->id]) }}">
                @csrf
                <div class="profile-title-s m-3">
                    <label for="description">Description for the Boss</label><br>
                    <input type="text" name="description" required class="textarea-boss">
                </div>
                <div class="profile-title-s m-3">
                    <label for="passing_score">Setting Passing score</label><br>
                    <input type="number" name="passing_score" required><span>/100</span>
                </div>
                <div class="profile-title-s m-3">
                    <label for="badge_id" class="form-label">Badge List</label>
                    <div class="badge-list mt-3 d-flex flex-wrap">
                        @foreach ($badges as $badge)
                            <div class="badge-item text-center mx-2">
                                <img src="{{ asset('../images/' . $badge->badge_picture) }}" 
                                     alt="{{ $badge->badge_name }}" 
                                     width="50" 
                                     height="50">
                                <p class="mt-2">{{ $badge->badge_name }}</p>
                            </div>
                        @endforeach
                    </div>
                    <select name="badge_id" class="form-control select-badge-form" required>
                        <option value="" class="hidden">▼Select a Badge</option>
                        @foreach ($badges as $badge)
                            <option value="{{ $badge->id }}"
                                data-badge-name="{{ $badge->badge_name }}"
                                data-badge-picture="{{ $badge->badge_picture }}">
                                {{ $badge->badge_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- バッジのプレビュー -->
                <div id="badge-preview" class="m-3" style="display: none;">
                    <img id="badge-image" src="" alt="Selected Badge" width="100">
                    <p id="badge-name"></p>
                </div>
                
                <script>
                    document.querySelector('[name="badge_id"]').addEventListener('change', function() {
                        let selectedOption = this.options[this.selectedIndex];
                        let badgeName = selectedOption.dataset.badgeName;
                        let badgePicture = selectedOption.dataset.badgePicture;
                
                        if (badgeName && badgePicture) {
                            document.getElementById('badge-name').textContent = badgeName;
                            document.getElementById('badge-image').src = "{{ asset('images/') }}/" + badgePicture;
                            document.getElementById('badge-preview').style.display = "block";
                        } else {
                            document.getElementById('badge-preview').style.display = "none";
                        }
                    });
                </script>
                <label class="mt-5">設問の作成に進んでください。</label>
                <button type="submit" class="edit-button-container mx-3">Next</button>
            </form>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')


@section('content')
<div class="header-container d-flex justify-content-between align-items-center">
    <div class="container-fluid px-0">
        <div class="schedule-section" 
            style="background-image: url('{{ asset('images/Group 209.png') }}'); 
                    width: 100%; max-width: 900px; height: 80px; 
                    background-position: left;">
            <h2 class="section-title" style="font-size: 30px;">Watch Later</h2>
        </div>
    </div>
    <a href="{{ route('player.studyplan', Auth::id()) }}" 
        class="text-decoration-none border rounded px-2 ms-2 me-0 py-1 bg-white add-schedule-btn align-self-center"
        style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
          box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); white-space: nowrap; display: inline-block; 
          text-align: center; font-size: 14px;">
        View your schedule
    </a>
</div>
<div class="quest-list">
    <ul class="list-group list-unstyled">
        @if($watchLater->isEmpty())
            <h3 class="text-center" style="color: #261C11;">No quest</h3>
        @else
            @foreach($watchLater as $later)
            <li>
                <div class="d-flex align-items-center">
                    <div class="schedule-item d-flex flex-nowrap align-items-center p-2 mb-3"
                        style="color: #261C11; border: 1px solid #261C11; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
                                max-width: 100%; width: 88%; height: auto; min-height: 100px; overflow: hidden;">

                        <img src="{{ $later->quest->thumbnail }}" alt="quest image" class="quest-img"
                            style="max-width: 100px; height: auto; object-fit: cover; flex-shrink: 0;">

                        <div class="schedule-info d-flex flex-grow-1 align-items-center ms-2" style="min-width: 0; flex-shrink: 1;">
                            <div class="flex-grow-1">
                                <h3 class="mb-1" style="font-size: 18px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $later->quest->quest_title }}
                                </h3>
                                <p class="mb-1" style="font-size: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    Creator: {{ $later->quest->creator->creator_name }}
                                </p>
                                <p class="mb-0" style="font-size: 12px;">
                                    Last Updated: {{ $later->quest->updated_at->format('Y/m/d') }}
                                </p>
                            </div>
                            <div class="d-flex flex-wrap ms-2">
                                @foreach($later->quest->categories as $category)
                                    <span class="category-badge me-2 my-1" style="font-size: 12px;">{{ $category->category_name }}</span>
                                @endforeach
                            </div>
                            <!-- カレンダーボタン：モーダルをトリガー -->
                            <button class="calendar-btn ms-3" data-bs-toggle="modal" data-bs-target="#scheduleModal-{{ $later->id }}">
                                <img src="{{ asset('images/calendar.jpg') }}" alt="calendar image" class="calendar-img" style="width: 30px; height: 30px;">
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('player.watchlater.delete', $later->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm border rounded px-2 py-2 bg-white ms-3"
                            style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <img src="{{ asset('images/image 85.png') }}" alt="treasure box" class="me-1" style="width: 20px; height: 20px;">
                            Delete
                        </button>
                    </form>
                </div>

                <div class="modal fade" id="scheduleModal-{{ $later->id }}" tabindex="-1" aria-labelledby="scheduleModalLabel-{{ $later->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('player.schedule', $later->id) }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #588157;">
                                    <h3 class="modal-title" id="scheduleModalLabel-{{ $later->id }}">Schedule Quest</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="schedule_date_{{ $later->id }}" class="form-label">Select a date:</label>
                                        <input type="date" name="schedule_date" id="schedule_date_{{ $later->id }}" class="form-control" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn border rounded px-3 py-2 bg-white ms-2"
                                            style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                                            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" >
                                            Schedule
                                        </button>
                                        <button type="button" class="btn border rounded px-3 py-2 bg-white ms-2" data-bs-dismiss="modal"
                                            style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                                            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" >
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
</div>
@endsection

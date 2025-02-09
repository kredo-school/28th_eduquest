@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

<div class="container p-3" style="background-color: #FCFCE7;">

    <h1 class="mb-4">
        <img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green"> Search Results
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
        <!-- Quest List -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-5 pb-3 pe-5">
            @foreach($quests as $quest)
                <div class="col">
                    <div class="quest-card p-2">
                        <!-- Thumbnail -->
                        <a href="{{ route('quests.chapters', $quest->id) }}">
                            <img src="{{ $quest->thumbnail }}" alt="Thumbnail">
                        </a>
                        <!-- Title -->
                        <a href="{{ route('quests.chapters', $quest->id) }}" class="text-dark text-decoration-none">
                            <h5 class="mt-2 mb-1">{{ $quest->quest_title }}</h5>
                        </a>
                        <!-- Creator Icon + Name -->
                        @if($quest->creator)
                            <div class="creator-info">
                                <a href="{{ route('questcreators.profile.view', $quest->creator->user_id) }}">
                                    @if($quest->creator->creator_image)
                                        <img src="{{ $quest->creator->creator_image }}" alt="Creator Icon">
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </a>
                                <a href="{{ route('questcreators.profile.view', $quest->creator->user_id) }}" class="text-dark text-decoration-none">
                                    <span>{{ $quest->creator->creator_name }}</span>
                                </a>
                            </div>
                        @else
                            <div class="creator-info">
                                <i class="fas fa-user"></i>
                                <span>Unknown Creator</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

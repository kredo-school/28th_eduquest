@extends('layouts.app')

@section('title', 'Welcome to EduQuest')

@section('content')
<div class="container">

    {{-- Newest Quests --}}
    <div class="container-fluid">
        <div style="background-color: #6ddce3;">
            <img src="{{ asset('images/Group 235.png') }}" alt="castle_background" class="w-75">
        </div>
        <h1 class="text-center">Hello! EduQuest World!!</h1>


        <div style="background-color:#FCFCE7;">
            @if($newestQuests->isEmpty())
                <p>No quests found.</p>
            @else
            
                <div class="horizontal-scroll newest-quests-row px-3 mb-5" >
                    @foreach($newestQuests as $quest)
                        <div class="card quest-item mx-1" style="width: 200px;">
                            
                            {{-- Thumbnail --}}
                            @if($quest->thumbnail)
                                <div class="aspect-ratio-16-9">
                                    <a href="{{ route('quests.chapters', $quest->id) }}">
                                        <div class="aspect-ratio-16-9-inner">
                                            <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail">
                                        </div>
                                    </a>
                                </div>
                            @else
                                <div class="aspect-ratio-16-9 no-image-box">
                                    <span class="no-image-text-center">No Image</span>
                                </div>
                            @endif

                            {{-- Categories Badge --}}
                            <div class="mt-1">
                                @foreach ($quest->categoryQuests as $qCat)
                                    @if($qCat->category)
                                        <span class="category-badge">
                                            {{ $qCat->category->category_name }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>

                            {{-- Quest Title --}}
                            <a href="{{ route('quests.chapters', $quest->id) }}" class="text-dark text-decoration-none">
                                <div class="ms-1 mt-1">{{ $quest->quest_title }}</div>
                            </a>

                            {{-- Creator Icon + Name --}}
                            @if($quest->questCreator)
                                @php
                                    $creator = $quest->questCreator;
                                @endphp
                                <div class="card-body d-flex align-items-center">
                                    @if($creator->creator_image)
                                        <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                            <img src="{{ $creator->creator_image }}" alt="Creator Icon"
                                                style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;">
                                            <span class="ms-1">{{ $creator->creator_name }}</span>
                                        </a>
                                    @else
                                        <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                            <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                            <span class="ms-1">{{ $creator->creator_name }}</span>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="card-body d-flex align-items-center">
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                    <span class="ms-1">Unknown Creator</span>
                                </div>
                            @endif
                            
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
    </div>
    
    {{-- Quest List by Category --}}
    <div class="container">
        <div class="d-flex justify-content-center">
            <div style="transform: scale(0.66); transform-origin: top center;">
                <h1 class="mb-3">
                    <img src="{{ asset('images/flag_green.png') }}" alt="category flag" class="flag_green">
                    Quest List by Category
                </h1>

                @foreach ($categories as $category)
                    <div class="mt-3">
                        <h4>
                            <img src="{{ asset('images/Sword Icon 02.png') }}" alt="sword" class="flag_green">
                            {{ $category->category_name }}
                        </h4>
                        
                        <div class="horizontal-scroll quests-row px-3">
                            @forelse ($category->categoryQuests as $catQuest)
                                @php
                                    $quest = $catQuest->quest;
                                @endphp
                                <div class="card quest-item mx-1" style="width: 200px;">
                                    
                                    {{-- Thumbnail --}}
                                    @if ($quest->thumbnail)
                                        <div class="aspect-ratio-16-9">
                                            <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                                <div class="aspect-ratio-16-9-inner">
                                                    <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail">
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                            <div class="aspect-ratio-16-9 no-image-box">
                                                <span class="no-image-text-center">No Image</span>
                                            </div>
                                        </a>
                                    @endif

                                    {{-- Category Badge) --}}
                                    <div>
                                        @foreach ($quest->categoryQuests as $qCat)
                                            @if($qCat->category)
                                                <span class="category-badge">
                                                    {{ $qCat->category->category_name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- Quest Title --}}
                                    <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                        <div class="ms-1 mt-1">{{ $quest->quest_title }}</div>
                                    </a>

                                    {{-- Creator --}}
                                    @if($quest->questCreator)
                                        @php
                                            $creator = $quest->questCreator;
                                        @endphp
                                        <div class="card-body d-flex align-items-center">
                                            @if($creator->creator_image)
                                                <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                                    <img src="{{ $creator->creator_image }}" alt="Creator Icon"
                                                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;">
                                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-body d-flex align-items-center">
                                            <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                            <span class="ms-1">Unknown Creator</span>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p>No quests in this category</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('main-class', '')

@section('content')

<div class="container">
    {{-- Newest Quests --}}
    <div class="container-fluid">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/edu-quest.png') }}" alt="castle_background" style="width: 50rem;" class="animated-logo">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="#newQuests">
                <img src="{{ asset('images/Group 301.png')}}" alt="" class="hover-effect" style="width: 30rem; margin: 2rem; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);">
            </a>
        </div>
        <div id="newQuests">
            <img src="{{ asset('images/Group 315.png')}}" alt="new quest" style="width: 20rem; margin-top: 5rem;">
        </div>

        <div style="background-color:#FCFCE7;">
            @if($newestQuests->isEmpty())
                <p>No quests found.</p>
            @else

            <div class="marquee-container" id="marqueeContainer">
                <div class="marquee" id="marquee">
            
                <div class="horizontal-scroll newest-quests-row p-3">
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
                            <div class="quest-categories">
                                @foreach ($quest->categoryQuests as $qCat)
                                    @if($qCat->category)
                                        <span class="category-badge mx-1">
                                            {{ $qCat->category->category_name }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>

                            {{-- Quest Title --}}
                            <a href="{{ route('quests.chapters', $quest->id) }}" class="text-dark text-decoration-none">
                                <div class="ms-2 mt-1">{{ $quest->quest_title }}</div>
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
            </div>
                </div>
            @endif
            
        </div>
    </div>
    
    {{-- Quest List by Category --}}
    <div class="container-fluid mt-5" style="padding: 0 30px;"> <!-- Adjusted padding for more space -->
        <div style="width: 100%;">
                <h1 class="mb-3" style="font-size: 1.7rem;"> <!-- Increased font size -->
                    <img src="{{ asset('images/flag_green.png') }}" alt="category flag" class="flag_green" style="width: 2rem; height: auto;">
                    Quest List by Category
                </h1>

                @foreach ($categories as $category)
                    <div class="mt-3">
                        <h4 style="font-size: 1.5rem;"> <!-- Increased font size -->
                            <img src="{{ asset('images/Sword Icon 02.png') }}" alt="sword" class="flag_green" style="width: 2rem; height: auto;">
                            {{ $category->category_name }}
                        </h4>
                        
                        <div class="horizontal-scroll-category quests-row-category p-3">
                            @forelse ($category->categoryQuests as $catQuest)
                                @php
                                    $quest = $catQuest->quest;
                                @endphp
                                <div class="card quest-item mx-1" style="width: 200px;"> <!-- Increased card width -->
                                    
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

                                    {{-- Category Badge --}}
                                    <div>
                                        @foreach ($quest->categoryQuests as $qCat)
                                            @if($qCat->category)
                                                <span class="category-badge" style="font-size: 0.8rem;"> <!-- Increased font size -->
                                                    {{ $qCat->category->category_name }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- Quest Title --}}
                                    <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                        <div class="ms-2 mt-1" style="font-size: 0.8rem;"> <!-- Increased font size -->
                                            {{ $quest->quest_title }}
                                        </div>
                                    </a>

                                    {{-- Creator --}}
                                    @if($quest->questCreator)
                                        @php
                                            $creator = $quest->questCreator;
                                        @endphp
                                        <div class="card-body d-flex align-items-center" style="font-size: 1rem;"> <!-- Increased font size -->
                                            @if($creator->creator_image)
                                                <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                                    <img src="{{ $creator->creator_image }}" alt="Creator Icon"
                                                        style="width: 2rem; height: 2rem; object-fit: cover; border-radius: 50%;"> <!-- Increased image size -->
                                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                                </a>
                                            @else
                                                <a href="{{ route('questcreators.profile.view', ['id'=>$creator->id]) }}">
                                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 1rem;"></i> <!-- Increased icon size -->
                                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @else
                                        <div class="card-body d-flex align-items-center" style="font-size: 1.2rem;">
                                            <i class="fa-solid fa-circle-user text-secondary" style="font-size: 1rem;"></i> <!-- Increased icon size -->
                                            <span class="ms-1">Unknown Creator</span>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p style="font-size: 1rem;">No quests in this category</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center" style="margin-top: 1rem; padding: 0;">
    <img src="{{ asset('images/Group 305.png')}}" style="width: 50rem;">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const marquee = document.getElementById("marquee");
    const speed = 0.7; // スクロール速度（ピクセル/フレーム）

    // コンテンツを複製して、途切れないようにする
    const clone = marquee.cloneNode(true);
    marquee.parentElement.appendChild(clone); // 直後に追加

    function animate() {
        let currentX = parseFloat(getComputedStyle(marquee).transform.split(",")[4]) || 0;
        
        // 左へスクロール
        marquee.style.transform = `translateX(${currentX - speed}px)`;
        clone.style.transform = `translateX(${currentX - speed}px)`;

        const contentWidth = marquee.scrollWidth; // もともとのコンテンツの幅

        // もし元のコンテンツが完全に消えたらリセット
        if (Math.abs(currentX) >= contentWidth) {
        marquee.style.transform = `translateX(0)`;
        clone.style.transform = `translateX(0)`;
        }

        requestAnimationFrame(animate);
    }

    animate();
});
  </script>
  <!-- Font Awesome の読み込み (必要に応じて) -->
  <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
@endsection

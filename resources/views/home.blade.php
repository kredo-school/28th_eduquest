@extends('layouts.app')

@section('title', 'Player Home')

@section('content')

{{-- Top left：Profile Overview gx-5--}}
<div class="row gx-5"> 
    <div class="col-5 text-start">
        <div class="row align-items-start mb-3 bg-white shadow-sm round-10 py-2 border-color">
            <div class="col-auto">
                {{-- えー、リンクつける？ --}}
                @if (Auth::user()->image)
                    <a href="{{ route('player.mypage', Auth::user()->id) }}">
                        <img src="{{ Auth::user()->image }}" alt=" {{ Auth::user()->name }} " class="rounded-circle image-md">
                    </a>    
                @else
                    <a href="{{ route('player.mypage', Auth::user()->id) }}">
                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                    </a>
                @endif
            </div>
            <div class="col">
                <h2 class='h5'>Welcome back, {{ Auth::user()->player_nickname }} !!</h2>
            </div>
        </div>
    </div>
</div>


{{-- News modal--}}
@include('modals.news')

{{-- Ranking --}}
<div class="row gx-5">
    <div class="h2 h3 mt-3">
        <img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Ranking
    </div>

    <div class="ranking-container">

        {{-- creator ranking --}}
        <div class="creator-ranking-container">
            <h4>Creator Ranking</h4>
            <div class="ranking-content-wrapper">
                @foreach ($rankingCreators as $index => $creator)
                    {{-- １位, 2位, 3位に画像を追加 --}}
                <div class="ranking-content">
                    <div class="top3-image">
                        @if ($index == 0)
                            <img src="{{ asset('images/ingot_gold 1.png')}}" alt="gold">
                        @elseif ($index == 1)
                            <img src="{{ asset('images/ingot_silver 1.png')}}" alt="silver">
                        @elseif ($index == 2)
                            <img src="{{ asset('images/ingot_copper 1.png')}}" alt="bronze">
                        @else
                            <div style="width: 3rem; height: 3rem;"></div>
                        @endif
                    </div>
                    
                    <div class="ranking-list">
                        <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                            @if ($creator && $creator->creator_image)
                                <img src="{{ $creator->creator_image }}" alt="icon_image">
                            @else  
                                <img src="{{ asset('images/User icon.png') }}" alt="icon_image">
                            @endif
                            <span class="ms-1">{{ $creator->creator_name }}</span> (<i class="fa-solid fa-star text-warning fa-1x"></i>{{ $creator->favorites_count }})
                        </a>  
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- player ranking --}}
        <div class="player-ranking-container">
            <h4>Player Ranking</h4>
            <div class="ranking-content-wrapper">
                @foreach ($rankingCreators as $index => $creator)
                    {{-- １位, 2位, 3位に画像を追加 --}}
                <div class="ranking-content">
                    <div class="top3-image">
                        @if ($index == 0)
                            <img src="{{ asset('images/ingot_gold 1.png')}}" alt="gold">
                        @elseif ($index == 1)
                            <img src="{{ asset('images/ingot_silver 1.png')}}" alt="silver">
                        @elseif ($index == 2)
                            <img src="{{ asset('images/ingot_copper 1.png')}}" alt="bronze">
                        @else
                            <div style="width: 3rem; height: 3rem;"></div>
                        @endif
                    </div>
                    
                    <div class="ranking-list">
                        <a href="{{ route('questcreators.profile.view', ['id' => $creator->id])}}">
                            @if ($creator && $creator->creator_image)
                                <img src="{{ $creator->creator_image }}" alt="icon_image">
                            @else  
                                <img src="{{ asset('images/User icon.png') }}" alt="icon_image">
                            @endif
                            <span class="ms-1"><img src="{{ asset('images/Polygon 15.png') }}" alt="バッチ"></span> 
                        </a>  
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


{{-- Quest list each Categories--}}
<div class="row gx-5">
    <h2 class="h3 mt-3"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Quest List</h2>

    @foreach ($categories as $category)
        {{--  Category Title  --}}
        <div class="mt-3">
            <h4><img src="{{ asset('images/Sword Icon 02.png') }}" alt="sword" class="flag_green">{{ $category->category_name }}</h4>
        {{-- Quests Scroll --}}
        <div class="horizontal-scroll-category quests-row-category p-3">
            <!-- Thumbnail with spacing -->
            @forelse ($category->categoryQuests as $catQuest)
            @php
                $record = Auth::user()->userQuests
                  ->where('quest_id', $catQuest->quest->id)
                  ->first();

                $status = $record ? $record->status : null;
            @endphp
                <div class="card quest-item mx-1" style="width: 200px;">
                    @if ($catQuest->quest->thumbnail)
                        {{-- Thumbnail --}}
                        <div class="aspect-ratio-16-9">
                            <a href="{{ route('quests.chapters', ['id' => $catQuest->quest->id]) }}">
                                <div class="aspect-ratio-16-9-inner">
                                    <img src="{{ $catQuest->quest->thumbnail }}" alt="Quest Thumbnail">
                                </div>
                            </a>
                        </div>
                        {{-- Categories --}}
                        <div>
                            @foreach ($catQuest->quest->categoryQuests as $qCat)
                                <span class="category-badge">
                                    {{ $qCat->category->category_name }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Quest Title + Watch Later icon in one row --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Left: Quest Title link -->
                            <a href="{{ route('quests.chapters', ['id' => $catQuest->quest->id]) }}" class="text-dark text-decoration-none ps-2">
                                <span>{{ $catQuest->quest->quest_title }}</span>
                            </a>

                            <!-- Right: Status Toggle Button -->

                            @if (is_null($status))
                                {{-- まだ登録されていない → 透明旗をクリックしたらwatchLater(0)にする --}}
                                <form action="{{ route('watch.later.toggle', $catQuest->quest->id) }}" 
                                    method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light" style="border: none;">
                                        <img src="{{ asset('images/flag_transparent.png') }}" alt="flag_transparent" class="flag_transparent">
                                    </button>
                                </form>
                            @elseif ($status == 0)
                                {{-- status=0 (Watch Later) → クリックすると解除 (→レコード削除 or ロジックによってはinProgressに) --}}
                                <form action="{{ route('watch.later.toggle', $catQuest->quest->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-light" style="border:none;">
                                        <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                                    </button>
                                </form>
                            @elseif ($status == 1)
                                {{-- status=1 (In Progress) → 赤旗を表示するが、クリックしても変更しない --}}
                                <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                            @elseif ($status == 2)
                                {{-- status=2 (Completed) → 赤旗を表示するが、クリックしても変更しない --}}
                                <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                            @endif
                        </div>

                        {{-- Creator Icon + Creator name--}}
                        <div class="card-body" style="display: flex; align-items: center;">
                            @php
                                $creator = $catQuest->quest->questCreator;
                            @endphp
                            @if($creator && $creator->creator_image)
                                <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                                    <img src="{{ $creator->creator_image }}" alt="Creator Icon" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;">
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @else
                                <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @endif
                        </div>  
                    @else  
                        <a href="{{ route('quests.chapters', ['id' => $catQuest->quest->id]) }}">
                            <div class="aspect-ratio-16-9 no-image-box">
                                    <span class="no-image-text-center">
                                        No Image
                                    </span>
                            </div>
                        </a>
                        {{-- Categories --}}
                        <div>
                            @foreach ($catQuest->quest->categoryQuests as $qCat)
                                <span class="category-badge">
                                    {{ $qCat->category->category_name }}
                                </span>
                            @endforeach
                        </div>
                        {{-- Quest Title --}}
                        <a href="{{ route('quests.chapters', ['id' => $catQuest->quest->id]) }}">
                            <div style="margin-left: 8px;">{{ $catQuest->quest->quest_title }}</div>
                        </a>

                        {{-- Creator Icon --}}
                        <div class="card-body" style="display: flex; align-items: center;">
                            @php
                                $creator = $catQuest->quest->questCreator;
                            @endphp
                            @if($creator && $creator->creator_image)
                                <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                                    <img
                                    src="{{ $creator->creator_image }}"
                                    alt="Creator Icon"
                                    style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;"
                                    >
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @else
                                <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <p>No quests in this category</p>
            @endforelse
        </div>
    @endforeach    
</div>
    
@endsection

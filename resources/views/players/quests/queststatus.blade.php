@extends('layouts.app')

@section('title', 'My Quests Status')

@section('content')
<div class="row gx-5">
    {{-- Quests Scroll --}}
    <div class="quests-row">
        <div class="horizontal-scroll px-3">

            <h2><img src="{{ asset('images/flag_red.png') }}" alt="Red Flag" class="flag_red_status pe-1">In Progress</h2>

            <!-- Thumbnail with spacing -->
            @forelse ($category->categoryQuests as $catQuest)
            <div class="card quest-item mx-1" style="width: 200px;">
                @if ($catQuest->quest->thumbnail)
                    {{-- Thumbnail --}}
                    <div class="aspect-ratio-16-9">
                        {{-- あとでリンク追加必要！！！ --}}
                        <a href="#">
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
                    {{-- Quest Title --}}
                    {{-- あとでリンク追加必要！！！ --}}
                    <a href="#">
                        <div style="margin-left: 8px;">{{ $catQuest->quest->quest_title }}</div>
                    </a>
                    {{-- Creator Icon + Creator name--}}
                    <div class="card-body" style="display: flex; align-items: center;">
                        @php
                            $creator = $catQuest->quest->questCreator;
                        @endphp
                        @if ($creator)
                            @if ($creator->creator_image)
                                {{-- あとでリンク追加必要！！！ --}}
                                <a href="#">
                                    <img
                                        src="{{ $creator->creator_image }}"
                                        alt="Creator Icon"
                                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;"
                                    >
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @else
                                {{-- あとでリンク追加必要！！！ --}}
                                <a href="#">
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @endif
                        @else
                            {{-- クリエイター情報がない場合 --}}
                            <a href="#">
                                <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                <span class="ms-1">Unknown</span>
                            </a>
                        @endif
                    </div>
                @else
                    {{-- No Thumbnail --}}
                    {{-- あとでリンク追加必要！ --}}
                    <a href="#">
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
                    {{-- あとでリンク追加必要！！！ --}}
                    <a href="#">
                        <div style="margin-left: 8px;">{{ $catQuest->quest->quest_title }}</div>
                    </a>
                    {{-- Creator Icon + Creator name --}}
                    <div class="card-body" style="display: flex; align-items: center;">
                        @php
                            $creator = $catQuest->quest->questCreator;
                        @endphp
                        @if ($creator)
                            @if ($creator->creator_image)
                                {{-- あとでリンク追加必要！！！ --}}
                                <a href="#">
                                    <img
                                        src="{{ $creator->creator_image }}"
                                        alt="Creator Icon"
                                        style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;"
                                    >
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @else
                                {{-- あとでリンク追加必要！！！ --}}
                                <a href="#">
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                    <span class="ms-1">{{ $creator->creator_name }}</span>
                                </a>
                            @endif
                        @else
                            {{-- クリエイター情報がない場合 --}}
                            <a href="#">
                                <i class="fa-solid fa-circle-user text-secondary" style="font-size: 32px;"></i>
                                <span class="ms-1">Unknown</span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <p>No quests in this category</p>
        @endforelse
    
    
            
        </div>
    </div>
    

</div>
@endsection

@extends('layouts.app')

@section('title', 'Player Home')

@section('content')
<style>
    .image-md{
        width: 3.5rem;
        height: 3.5rem;
        object-fit: cover;
    }

    .icon-md{
        font-size: 3.5rem;
    }

    .border-color{
        border: 1px solid #3C2C1B;
    }
    
    .round-10{
        border-radius: 10px;
    }

    .btn-custom-border {
        border-color: #3C2C1B !important;
    }

    /* 左寄せを強調 */
    .profile-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* 左寄せ */
    }

    .news-button {
        margin-top: 15px; /* ボタンの間隔を調整 */
        width: 100%; /* ボタンが親要素の幅いっぱいに広がる */
    }

    .truncate-2-lines {
        display: -webkit-box;              /* 必須: ブロック要素化 + flexboxベース */
        -webkit-box-orient: vertical;      /* 縦方向にボックスを並べる */
        -webkit-line-clamp: 2;            /* 2行で切り捨て */
        overflow: hidden;                  /* はみ出した部分を非表示に */
        text-overflow: ellipsis;          /* 省略記号をつける(Chrome等で有効) */
    }


    .quests-row {
        background-color: #FCFCE7;
    }

    .horizontal-scroll {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        /* gap: 1rem; */
    }

    .quest-item {
        flex: 0 0 auto;
        width: 200px;
        background-color: #EDEBEB;
    }

    .quest-item a {
        color: black;
        text-decoration: none;
    }

    .aspect-ratio-16-9 {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        overflow: hidden;
        background-color: #EDEBEB;
    }

    .aspect-ratio-16-9-inner {
        position: absolute;
        top: 8px;
        left: 8px;
        right: 8px;
        bottom: 8px;
        overflow: hidden; /* 念のため */
    }

    .aspect-ratio-16-9-inner img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .no-image-box {
        background-color: #ccc;
        position: relative;
    }

    .no-image-box .no-image-text-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #000;
        font-weight: bold;
    }

    .flag_green {
    width: 1.5rem;
    height: 1.5rem; 
    margin-right: 10px;
    }  

    .category-badge {
    background-color: #588157; 
    color: #fff;  
    margin-left: 5px;    
    padding: 2px 6px;         /* 内側の余白 */
    border-radius: 3px;       /* 角丸 */
    font-size: 0.7rem;        /* 大きさ微調整 */
    margin-right: 4px;        /* バッジ同士の隙間 */
}

</style>

{{-- Top left：Profile Overview gx-5--}}
<div class="row gx-5"> 
    <div class="col-5 text-start">
        <div class="row align-items-start mb-3 bg-white shadow-sm round-10 py-2 border-color">
            <div class="col-auto">
                @if (Auth::user()->image)
                    <img src="{{ Auth::user()->image }}" alt=" {{ Auth::user()->name }} " class="rounded-circle image-md">                            
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                @endif
            </div>
            <div class="col">
                <h2 class='h5'>Welcome back, {{ Auth::user()->player_nickname }} !!</h2>
            </div>
        </div>
    </div>
</div>

{{-- News modal--}}
@include('players.modals.news')

{{-- Ranking --}}
{{-- <div class="row gx-5">
    <div class="h2 h3 mt-3"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Ranking</div>

</div> --}}


{{-- Quest list each Categories--}}
<div class="row gx-5">
    <h2 class="h3 mt-3"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Quest List</h2>

    @foreach ($categories as $category)
        {{--  Category Title  --}}
        <div class="mt-3">
            <h4><img src="{{ asset('images/Sword Icon 02.png') }}" alt="sword" class="flag_green">{{ $category->category_name }}</h4>
        
        
        {{-- Quests Scroll --}}
        <div class="horizontal-scroll quests-row px-3">
            <!-- Thumbnail with spacing -->
            <div class="px-2 pt-2">
                <div class="quest-thumbnail-container position-relative bg-white" style="padding-top: 56.25%;">
                    @if($catQuest->quest->thumbnail)
                        <img src="{{ $catQuest->quest->thumbnail }}" 
                             class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
                             alt="{{ $catQuest->quest->quest_title }}"
                             style="object-position: center;">
                    @else
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                            <span class="text-muted" style="font-family: 'DotGothic16', sans-serif;">Thumbnail</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Category Badge -->
            <div class="px-2 py-2">
                @foreach ($catQuest->quest->categoryQuests as $qCat)
                    <span class="category-badge">
                        {{ $qCat->category->category_name }}
                    </span>
                @endforeach
                {{-- @if($quest->categories->first())
                    <a href="{{ route('quests.category', $quest->categories->first()) }}" 
                       class="text-decoration-none">
                        <span class="badge" style="background-color: #4a7555; font-size: 0.8rem; font-family: 'DotGothic16', sans-serif;">
                            {{ $quest->categories->first()->category_name }}
                        </span>
                    </a>
                @else
                    <span class="badge" style="background-color: #4a7555; font-size: 0.8rem; font-family: 'DotGothic16', sans-serif;">
                        Categories
                    </span>
                @endif --}}
            </div>

            <!-- Quest Info -->
            <div class="card-body px-2">
                @php
                    $creator = $catQuest->quest->questCreator;
                @endphp
                <h5 class="card-title mb-2" style="font-family: 'DotGothic16', sans-serif; font-size: 0.9rem;">{{ $catQuest->quest->quest_title }}</h5>
                
                <!-- Creator Info -->
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle overflow-hidden" style="width: 30px; height: 30px;">
                        <img src="{{ url('images/character_yusha_01_green.png') }}" alt="Creator Avatar" class="w-100 h-100 object-fit-cover">
                    </div>
                    <span style="font-family: 'DotGothic16', sans-serif; font-size: 0.8rem;">{{ $quest->creator->creator_name ?? 'Unknown' }}</span>
                </div>
            </div>
           
        </div>
    @endforeach    
</div>
    
@endsection

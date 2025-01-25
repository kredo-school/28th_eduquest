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

    .quests-row {
        background-color: #FCFCE7;
    }

    .horizontal-scroll {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        gap: 1rem;
    }

    .quest-item {
        flex: 0 0 auto;
        width: 200px;
    }

    .aspect-ratio-16-9 {
        position: relative;    /* 内部の <img> を絶対配置するため */
        width: 100%;           /* 横幅を自由に使いたい場合 */
        padding-bottom: 56.25%; /* 16:9 = 9/16 = 0.5625 → 56.25% */
        overflow: hidden;      /* 子要素がはみ出ないように */
    }

    .aspect-ratio-16-9 img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover; /* or object-fit: contain; など */
    }

    .no-image-text {
        /* 親の .aspect-ratio-16-9 を相対配置にしているので、ここで絶対配置すれば中央寄せ可能 */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); 
        text-align: center;
        color: #666;       /* 任意。見やすい色を */
        font-size: 0.9rem; /* 任意。大きさを調整 */
        width: 80%;        /* テキストが長い場合のために少し余裕を持たせる */
    }

    .flag_green{
    width: 1.5rem;
    height: 1.5rem; 
    margin-right: 10px;
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
<div class="row gx-5">
    <div class="h2 h3 mt-3"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Ranking</div>

</div>


{{-- Quest list each Categories--}}
<div class="row gx-5">
    <h2 class="h3 mt-3"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Quest List</h2>

    @foreach ($categories as $category)
        {{--  Category Title  --}}
        <div class="mt-3">
            <h4>{{ $category->category_name }}</h4>
        
        
        {{-- Container --}}
        <div class="horizontal-scroll quests-row p-2">
            @forelse ($category->categoryQuests as $catQuest)
                <div class="card quest-item" style="width: 200px;">
                    @if ($catQuest->quest->thumbnail)
                        <a href="#">
                            <div class="aspect-ratio-16-9">
                                <img src="{{ $catQuest->quest->thumbnail }}" alt="Quest Thumbnail">
                            </div>

                            <div class="card-body">
                                <div>{{ $catQuest->quest->quest_title }}</div>
                            </div>
                        </a>
                    @else
                        <a href="#">
                            <div class="no-image-text">
                                {{ $catQuest->quest->quest_title ?? 'No image' }}
                            </div>
                            <div class="card-body">
                                <div>{{ $catQuest->quest->quest_title }}</div>
                            </div>
                        </a>
                    @endif  
                </div>
            @empty
                <p>No quests in this category</p>
            @endforelse
        </div>
    @endforeach    
</div>
    
@endsection

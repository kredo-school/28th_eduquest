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

{{-- Quest list each Categories だけど、CategoryとQuestデータ貯まるまで枠だけ--}}
<div class="row gx-5">
    <h2 class="h3 mt-3">Quest List</h2>
    <div class="row d-flex frex-wrap">
        @foreach ($quests as $quest)
            <div class="p-2" style='width: 200px;'>
                <a href="">
                    <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail" class="img-fluid mb-2">
                    <div>{{ $quest->quest_title }}</div>
                </a>
            </div>  
        @endforeach
    </div>
</div>
    
@endsection

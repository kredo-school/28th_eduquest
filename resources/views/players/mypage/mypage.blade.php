@extends('layouts.app')

@section('title', 'Player My page')

@section('content')
<div class="container">
  <!-- flex-column (モバイルでは縦並び) & flex-md-row (中サイズ以上は横並び)
       align-items-md-stretch: 中サイズ以上では子要素が同じ高さに伸びる -->
  <div class="row flex-column flex-md-row align-items-md-stretch gap-3">
    <!-- Left side bar -->
    <div class="m-side-bar col-12 col-md-2 bg-white p-3">
      <!-- Player Icon -->
      <div class="text-center">
        @if(auth()->user()->image)
            <img src="{{ asset(auth()->user()->image) }}" alt="playerimage" class="m-player-image rounded-circle">
        @else
            <img src="{{ asset('images/User icon.png') }}" alt="playerimage" class="player-image">
        @endif
      </div>
      <!-- Player Name -->
      <div class="player-nickname text-center" style="color: #261C11;">
        <h4>{{ Auth::user()->player_nickname }}</h4>
      </div>
      <!-- Batch -->
      <div class="text-center">
        <img src="{{ asset('images/Batch.png') }}" alt="Batchimage" class="Batch-image">
      </div>
      <!-- Player Details -->
      <div class="text-center" style="color: #261C11;">
        <p class="fs-6 mb-1">Player number: 00{{ Auth::user()->id }}</p>
        <p class="fs-6 mb-3">Started: {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('Y/m/d') }}</p>
      </div>
    </div><!-- /m-side-bar -->
    
    <!-- Right side bar -->
    <div class="m-side-bar-right col-12 col-md-8 bg-white p-3 d-flex flex-column justify-content-center">
      <!-- 1行目: アイコン＋テキスト -->
      <div class="row py-4 justify-content-center">
        <!-- Watch Later -->
        <div class="col d-flex align-items-center justify-content-center" style="color: #261C11;">
          <img src="{{ asset('images/home.png') }}" alt="homeimage" class="home-image me-2">
          <div class="text">Watch Later</div>
        </div>
        <!-- In Progress -->
        <div class="col d-flex align-items-center justify-content-center" style="color: #261C11;">
          <img src="{{ asset('images/sword.png') }}" alt="swordimage" class="sword-image me-2">
          <div class="text">In Progress</div>
        </div>
        <!-- Completed -->
        <div class="col d-flex align-items-center justify-content-center" style="color: #261C11;">
          <img src="{{ asset('images/image 83.png') }}" alt="boximage" class="box-image me-2">
          <div class="text">Completed</div>
        </div>
      </div><!-- /row -->
      
      <!-- 2行目: 数字 -->
      <div class="row pb-2 justify-content-cente mt-4">
        <!-- Watch Later の下 -->
        <div class="col text-center" style="color: #261C11;">
          <a href="{{ route('quest.status', Auth::user()->id) }}" class="text-decoration-none fs-1" style="color: #261C11;">{{ $watchlaterCount }}</a>
        </div>
        <!-- In Progress の下 -->
        <div class="col text-center" style="color: #261C11;">
          <a href="{{ route('quest.status', Auth::user()->id) }}" class="text-decoration-none fs-1" style="color: #261C11;">{{ $inProgressCount }}</a>
        </div>
        <!-- Completed の下 -->
        <div class="col text-center" style="color: #261C11;">
          <a href="{{ route('quest.status', Auth::user()->id) }}" class="text-decoration-none fs-1" style="color: #261C11;">{{ $clearedQuestsCount }}</a>
        </div>
      </div><!-- /row -->
    </div><!-- /m-side-bar-right -->
  </div><!-- /row -->
</div>
@endsection

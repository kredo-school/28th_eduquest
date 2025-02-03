@extends('layouts.app')
@section('title', 'Player My page')
@section('content')
<style>
  body {
    background-color: #FFFFF3;
    font-family: 'DotGothic16', sans-serif;
    color: #261C11;
  }
  /* 1 左のバー */
  .side-bar {
    border: 2px solid #261C11;
    border-radius: 20px;
    font-size: 6px;
    margin-left: 30px;
  }
  /* 右のバー */
  .side-bar-right {
    border: 2px solid #261C11;
    border-radius: 20px;
    font-size: 6px;
    margin-left: 30px;
  }
  /* 2 剣持った画像の事 */
  .player-image{
    height: 100px;
    width: 100px;
    margin-top: 50px;
    margin-bottom: 15px;
  }
  /* パチンコみたいな画像 */
  .Batch-image{
    height: 40px;
    width: 120px;
    margin-top: 50px;
    margin-bottom: 10px;
  }
  /* 4 Shogoの事 */
  .Shogo {
    font-size: 30px;
    line-height: 1.2;
    margin-bottom: 1px;
    margin-top: 1px;
  }
  /* homeアイコン */
  .home-image {
    width: 40px;
    height: 40px;
  }
  /* swordアイコン */
  .sword-image {
    width: 40px;
    height: 40px;
  }
    /* boxアイコン */
    .box-image {
    width: 40px;
    height: 40px;
  }
  /* 4 文字 */
  .text {
    font-size: 20px;
    margin-top: 8px; /* アイコンとの間を少し空ける */
  }
</style>
<div class="row text-center">
  <!-- ===== Left side bar ===== -->
  <div class="side-bar col-2 bg-white">
    <!-- Player Icon -->
    <div>
      <img src="{{ asset('images/User icon.png')}}" alt="playerimage" class="player-image">
    </div>
    <!-- Player Name -->
    <div class="Shogo" style="text-align: center">
      <p>Shogo</p>
    </div>
    <!-- Batch -->
    <div>
      <img src="{{ asset('images/Batch.png')}}" alt="Batchimage" class="Batch-image">
    </div>
    <!-- Player Details -->
    <div style="text-align: left">
      <p class="fs-6 mb-1">Player number: 0000008</p>
      <p class="fs-6 mb-1">Started day: 01/12/2024</p>
      <p class="fs-6 mb-1">Number of Cleared Quests: 12</p>
    </div>
  </div><!-- /side-bar -->
  <!-- ===== Right side bar ===== -->
  <div class="side-bar-right col-8 bg-white row py-4">
    <!-- 1行目: homeアイコン+text と swordアイコン+text を横並び -->
    <div class="row py-4">
      <!-- Watch Later -->
      <div class="col d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/home.png') }}" alt="homeimage" class="home-image me-2">
        <div class="text">Watch Later</div>
      </div>
      <!-- In Progress -->
      <div class="col d-flex align-items-center justify-content-center">
        <img src="{{ asset('images/sword.png') }}" alt="swordimage" class="sword-image me-2">
        <div class="text">In Progress</div>
      </div>
      <!-- Completed -->
      <div class="col d-flex align-items-center justify-content-center">
        <!-- もし Completed も要るなら -->
        <img src="{{ asset('images/box.png') }}" alt="boximage" class="box-image me-2">
        <div class="text">Completed</div>
      </div>
    </div><!-- /row -->
    <!-- 2行目: 08, 03, XX ... をアイコンの真下に配置 -->
    <!-- 同じrowで colを対応させる -->
    <div class="row pb-4">
      <!-- WatchLaterの下 -->
      <div class="col text-center">
        <a href="#" class="text-decoration-none fs-1 text-dark">08</a>
      </div>
      <!-- In Progressの下 -->
      <div class="col text-center">
        <a href="#" class="text-decoration-none fs-1 text-dark">03</a>
      </div>
      <!-- Completedの下 -->
      <div class="col text-center">
        <a href="#" class="text-decoration-none fs-1 text-dark">15</a>
      </div>
    </div>
  </div><!-- /side-bar-right -->
</div>
@endsection
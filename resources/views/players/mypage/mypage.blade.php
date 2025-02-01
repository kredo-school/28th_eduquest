@extends('layouts.app')

@section('title', 'Player My page')

@section('content')

{{-- 元の背景色のベース --}}
<style>
  body{
      background-color:#FFFFF3;
      font-family: 'DotGothic16', sans-serif;
      color: #261C11;
  }

/* 1　左のバー */
  .side-bar{
          border: 2px solid #261C11;
          border-radius: 20px;
          font-size: 6px;
          margin-left: 30px;
      }

/* 右のバー */
  .side-bar-right{
          border: 2px solid #261C11;
          border-radius: 20px;
          font-size: 6px;
          margin-left: 30px;
  }
  
/* 2　剣持った画像の事 */
  .player-image{
      height: 100px;
      width: 100px;
      margin-top: 50px;
      margin-bottom: 15px;
  }  

  /* 5　パチンコみたいな画像の事 */
  .Batch-image{
      height: 40px;
      width: 120px;
      margin-top: 50px;
      margin-bottom: 10px;
  }  

/* 4　shogoの事 */
  .Shogo{
      font-size: 30px;
      line-height: 1.2; /* 行間を狭める */
      margin-bottom: 1px; /* パラグラフ間の余白も調整 */
      margin-top: 1px;  
  }

  /* 5　家の画像 */
  .home-image{
      height: 40px;
      width: 40px;
      margin-top: 100px;
      margin-left: 200px;
  }  

    /* 5　剣の画像 */
    .sword-image{
      height: 40px;
      width: 40px;
      margin-top: 100px;
      margin-left: 200px;
  } 

  /* 4　2つの文字の事 */
  .text{
      font-size: 20px;
      margin-top: 30px;  
      text-align: left
  }

</style>


<body>

  {{-- 1. Icon + Account Menu --}}
  <div class="row text-center">
      <div class="side-bar col-2 bg-white">   
            
          {{-- 2. Player Icon --}}
          <div>
              <img src="{{ asset('images/User icon.png')}}" alt="playerimage" class="player-image">
          </div>
  
          {{-- 4. Player Name --}}
          <div class="Shogo" style="text-align: center">
              <p>Shogo</p>
          </div>

        {{-- パチンコみたいな画像 --}}
          <div>
              <img src="{{ asset('images/Batch.png')}}" alt="Batchimage" class="Batch-image">
          </div>
  
  
          {{-- 3. Player Details --}}
          <div style="text-align: left">
              <a href="#" class="text-decoration-none fs-6 text-dark">Player number: 0000008</a>
          </div>
  
          <div style="text-align: left">
              <a href="#" class="text-decoration-none fs-6 text-dark">Started day: 01/12/2024</a>
          </div>
  
          <div style="text-align: left">
              <a href="#" class="text-decoration-none fs-6 text-dark">Number of Cleared Quests: 12</a>
          </div>
      </div>

{{-- 1. Icon + Account Menu (Right Side) --}}
      <div class="side-bar-right col-8 bg-white">
      
        <div class="container">
          {{-- 行を作成 --}}
          <div class="row">
              {{-- 3列に分ける例 --}}
              <div class="col-md-6">
          {{-- 家の画像 --}}
                  <div style="text-align: left">
                      <img src="{{ asset('images/home.png')}}" alt="homeimage" class="home-image">
                      <p class="text">Watch Later</p>
                  </div>
              </div>
                <div class="col-md-4">
          {{-- 剣の画像 --}}
                  <div style="text-align: left">
                      <img src="{{ asset('images/sword.png')}}" alt="swordimage" class="sword-image">
                  <p class="text">In Progress</p>
                </div>
              </div>

      <div class="container">
        {{-- 行を作成 --}}
        <div class="row">
            {{-- 3列に分ける例 --}}
            <div class="col-md-4">
                第1列の内容
            </div>
            <div class="col-md-4">
                第2列の内容
            </div>
            <div class="col-md-4">
                第3列の内容
            </div>
        </div>
    
    </div>

      </div>
      <div class="container">
        {{-- 行を作成 --}}
        <div class="row">         
        <div style="text-align: left">
          <div class="col-md-6">
          <a href="#" class="text-decoration-none fs-1 text-dark">08</a>
        </div>
        <div class="col-md-6">
          <a href="#" class="text-decoration-none fs-1 text-dark">03</a>
        </div>
        </div>

    </div>
  </div>
  
  </body>
  
@endsection
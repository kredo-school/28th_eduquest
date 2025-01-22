@extends('layouts.app')
@section('title', 'Search Result')
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

/* 2　剣持った画像の事 */
    .player-image{
        height: 100px;
        width: 100px;
        margin-top: 30px;
        margin-bottom: 15px;
    }  

/* 3　ファイルを選択の下の2行の事 */
    .Accetable{
        font-size: 10px;
        line-height: 1.2; /* 行間を狭める */
        margin-bottom: 5px; /* パラグラフ間の余白も調整 */
        margin-top: 10px;
    }

/* 4　4つある剣の画像の事 */
    .sword{
        height: 40px;
        width: 40px;
    }
    
</style>
<body>





  
</body>
@endsection
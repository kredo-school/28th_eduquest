@extends('layouts.app')
@section('title', 'Creator Mypage')
@section('content')
    <style>
        body{
            background-color:#FFFFF3;
            font-family: 'DotGothic16', sans-serif;
            color: #261C11;
        }
        /* creator-profile */
        .creator-profile{
            background-color:#FFFFFF;
            border: 3px solid #588157;
            margin-right:20px;
        }
        .creator-name{
            font-size: 20px;
        }
        .creator-avator{
            display: block;
            margin:0 auto;
            border-radius: 50%;
            object-fit: cover;
            width: 200px;
            height: 200px;
            border: 3px solid #588157;
        }
        /* quest-management */
        .quest-management{
            position: relative;
            background-color: #FFFFFF;
            border: 3px solid #588157;
            margin-left:20px;
        }
        .quest-total{
            background-color: #C7D7AC;
            height: 100px;
            width: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .alphabet-q{
            height:40px;
            width:30px;
            margin-left: 20px;
            margin-right: 10px;
        }
        .alphabet-u{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-e{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-s{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-t{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        /* background-design */
        .red-dragon{
            position: absolute;
            width: 139px;
            height: 72px;
            bottom: 230px;
            right: 300px;
            transform: rotate(-10deg);
            background-color: white;
            opacity:0.5;
        }
        .blue-castle{
            position: absolute;
            width: 200px;
            height: 310px;
            bottom: 30px;
            right: 130px;
            background-color: white;
            opacity:0.5;
        }
        .yama-1{
            position: absolute;
            width: 65px;
            height: 55px;
            bottom: 30px;
            right: 60px;
            background-color: white;
            opacity:0.5;
        }
        .yama-2{
            position: absolute;
            width: 40px;
            height: 30px;
            bottom: 30px;
            right: 160px;
            background-color: white;
            opacity:0.6;
        }
        .mgt-btn{
            position: absolute;
            border: 2px solid #261C11;
            background-color: #FFFFFF;
            border-radius:40px;
            bottom:80px;
            left:100px;
            padding: 10px 100px;
            font-size:30px;
            z-index: 1000;
        }
    </style>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid mt-5 px-5">
            <div class="row justify-content-center gx-5">
                {{-- Creator Profile --}}
                <div class="creator-profile col-3 p-4">
                        <div class="d-flex justify-content-center">
                            <h3 class="creator-name fs-1 mx-auto my-3">John Doe</h3>
                        </div>
                        <img src={{ asset('img/creator-example.jpg') }} alt="Creator Example" class="creator-avator my-3">
                        <div class="job-title">
                            <p>Job title:</p>
                            <p class="fs-5">Web Designer / Graffic Designer</p>
                        </div>
                        <div class="Qualification">
                            <p>Qualification:</p>
                            <p class="fs-5">HTML /CSS /Photoshop /Illast..</p>
                        </div>
                        <div class="Introduction">
                            <p>Introduction:</p>
                            <p class="fs-5">I'm John Doe, a passionate web designer eager to help you create modern and creative websites with confidence. With expertise in tools like Photoshop and Illustrator, I bring a strong sense of des...</p>
                        </div>
                        <div class="sns-links text-center fs-3 p-3">
                            <i class="bi bi-youtube mx-3"></i>
                            <i class="bi bi-twitter-x mx-3"></i>
                            <i class="bi bi-facebook mx-3"></i>
                            <i class="bi bi-instagram mx-3"></i>
                            <i class="bi bi-linkedin mx-3"></i>
                        </div>
                        <div class="view-more text-center p-3" >
                            <a href="#" class="text-decoration-none fs-3">View more > </a>
                        </div>
                </div>
                {{-- Quest Management --}}
                <div class="quest-management col-7 p-4">
                    <h3 class="fs-1 m-3">Quest Management</h3>
                    <div class="quest-total col-4 my-5">
                        <img src={{ asset('img/alphabet_q.png') }} alt="Q" class="alphabet-q">
                        <img src={{ asset('img/alphabet_u.png') }} alt="U" class="alphabet-u">
                        <img src={{ asset('img/alphabet_e.png') }} alt="E" class="alphabet-e">
                        <img src={{ asset('img/alphabet_s.png') }} alt="S" class="alphabet-s">
                        <img src={{ asset('img/alphabet_t.png') }} alt="T" class="alphabet-t">
                        <span class="fs-1">: 24</span>
                    </div>
                    <button type="button" class="mgt-btn btn btn-light">Go To Management Page</button>
                    {{-- background-design --}}
                    <img src={{ asset('img/character_monster_dragon_03_red.png') }} alt="Red Dragon" class="red-dragon">
                    <img src={{ asset('img/shiro_03_brown_roof_blue.png') }} alt="Blue Castle" class="blue-castle">
                    <img src={{ asset('img/yama_02.png') }} alt="yama" class="yama-1">
                    <img src={{ asset('img/yama_02.png') }} alt="yama" class="yama-2">
                </div>
            </div>
        </div>
    </body>
@endsection
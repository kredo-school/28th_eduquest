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
            /*margin-right:10px;*/
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

        .profile-title-s{
            color: #646363;
            margin: 10px 0px;
        }

        .mute-text{
            font-size: 18px;
            color: #afafaf; 
        }

        .edit-button-container a {
            color: black;
            background: white;
        }


        /* quest-management */

        .quest-management{
            position: relative; 
            background-color: #FFFFFF;
            border: 3px solid #588157;
            margin-left:10px;
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
        <div class="container-fluid">
            <div class="row gx-5">
                {{-- Sub Profile --}}
                <div class="col-4 d-flex justify-content-center flex-column">
                        <div class="d-flex justify-content-center">
                            <h3 class="creator-name fs-1 mx-auto my-3">{{ $questcreator->creator_name}}</h3>
                        </div>
                        <img src={{ $questcreator->creator_image }} alt="Creator Example" class="creator-avator my-3">
                        <div class="sns-links text-center fs-3 p-3">
                            <a href="{{ $questcreator->youtube}}" class="{{ $questcreator->youtube ? 'text-danger' : 'text-secondary' }}"><i class="bi bi-youtube mx-3"></i></a>
                            <a href="{{ $questcreator->x_twitter}}"  class="{{ $questcreator->x_twitter ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-twitter-x mx-3"></i></a>
                            <a href="{{ $questcreator->facebook}}" class="{{ $questcreator->facebook ? 'text-primary' : 'text-secondary' }}"><i class="bi bi-facebook mx-3"></i></a>
                            <a href="{{ $questcreator->linkedin}}" class="{{ $questcreator->linkedin ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-linkedin mx-3"></i></a>
                        </div>
                        <div class="edit-button-container text-center p-3" >
                            <a href="#" class="text-decoration-none fs-3">Edit</a>
                        </div>
                </div>

                {{-- Main Profile --}}
                <div class="creator-profile col-8 p-4 d-flex flex-column">
                    <div class="job_title">
                        <p class="profile-title-s">Job Title:</p>
                        <p class="ms-3 fs-3">{{ $questcreator->job_title}}</p>
                    </div>
                    <div class="Qualification">
                        <p class="profile-title-s">Qualification:</p>
                        <p class="ms-3 fs-3">
                            @if($questcreator->qualifications)
                                {{ $questcreator->qualifications }}
                            @else
                                <span class="mute-text">Not set yet.</span>
                            @endif
                        </p>
                    </div>
                    <div class="Introduction">
                        <p class="profile-title-s">Introduction:</p>
                        <p class="ms-3 fs-3">
                            @if($questcreator->description)
                                {{ $questcreator->description }}
                            @else
                                <span class="mute-text">Not set yet.</span>
                            @endif
                        </p>
                    </div>
                </div>
               
            </div>
        </div>
    </body>
    


            
    
@endsection
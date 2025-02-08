@extends('layouts.app')

@section('title', 'Creator Mypage')

@section('content')
 
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center gx-5">
                {{-- Creator Profile --}}
                <div class="creator-profile col-4 p-4">
                        <div class="d-flex justify-content-center">
                            <h3 class="creator-name fs-1 mx-auto my-3">{{ $questcreator->creator_name}}</h3>
                        </div>
                        <img src={{ $questcreator->creator_image }} alt="Creator Example" class="creator-avatar my-3">
                        <div class="job-title">
                            <p>Job title:</p>
                            <p class="fs-5">{{ $questcreator->job_title}}</p>
                        </div>
                        <div class="Qualification">
                            <p>Qualification:</p>
                            <p class="fs-5">{{ $questcreator->qualifications}}</p>
                        </div>
                        <div class="Introduction">
                            <p>Introduction:</p>
                            <p class="fs-5">{{ $questcreator->description}}</p>
                        </div>
                        <div class="sns-links text-center fs-3 p-3">
                            <a href="{{ $questcreator->youtube}}" class="{{ $questcreator->youtube ? 'text-danger' : 'text-secondary' }}"><i class="bi bi-youtube mx-3"></i></a>
                            <a href="{{ $questcreator->x_twitter}}"  class="{{ $questcreator->x_twitter ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-twitter-x mx-3"></i></a>
                            <a href="{{ $questcreator->facebook}}" class="{{ $questcreator->facebook ? 'text-primary' : 'text-secondary' }}"><i class="bi bi-facebook mx-3"></i></a>
                            <a href="{{ $questcreator->linkedin}}" class="{{ $questcreator->linkedin ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-linkedin mx-3"></i></a>
                        </div>
                        <div class="creator-edit-button text-center p-3" >
                            <a href="{{ route('questcreators.profile.view', ['id' => $questcreator->id]) }}" class="text-decoration-none fs-3">Edit</a>
                        </div>
                </div>
                {{-- Quest Management --}}
                <div class="quest-management col-7 p-4">
                    <h3 class="fs-1 m-3">Quest Management</h3>
                    <div class="quest-total col-5 my-5">
                        <img src={{ asset('images/alphabet_q.png') }} alt="Q" class="alphabet-q">
                        <img src={{ asset('images/alphabet_u.png') }} alt="U" class="alphabet-u">
                        <img src={{ asset('images/alphabet_e.png') }} alt="E" class="alphabet-e">
                        <img src={{ asset('images/alphabet_s.png') }} alt="S" class="alphabet-s">
                        <img src={{ asset('images/alphabet_t.png') }} alt="T" class="alphabet-t">
                        <span class="fs-1">: {{ $questCount }}</span>
                    </div>
                    <button type="button" class="mgt-btn">Go To Management Page</button>

                    {{-- background-design --}}
                    <img src={{ asset('images/character_monster_dragon_03_red.png') }} alt="Red Dragon" class="red-dragon">
                    <img src={{ asset('images/shiro_03_brown_roof_blue.png') }} alt="Blue Castle" class="blue-castle">
                    <img src={{ asset('images/yama_02.png') }} alt="yama" class="yama-1">
                    <img src={{ asset('images/yama_02.png') }} alt="yama" class="yama-2">
                </div>
            </div>
        </div>
    </body>
            
    
@endsection
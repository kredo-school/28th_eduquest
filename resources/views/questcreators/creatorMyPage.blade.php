@extends('layouts.app')

@section('title', 'Creator Mypage')

@section('content')
 
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="creator-mypage-container">
            {{-- Creator Profile --}}
            <div class="creator-profile">
                <div class="d-flex justify-content-center">
                    <h3 class="creator-name fs-1 mx-auto my-3">{{ $questcreator->creator_name}}</h3>
                </div>
                <div class="creator-profile-image">
                    <img src={{ $questcreator->creator_image }} alt="Creator Example" class="creator-avatar my-3">
                </div>
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
                <div class="view-more text-center p-3" >
                    <a href="{{ route('questcreators.profile.view', ['id' => $questcreator->id]) }}" class="text-decoration-none fs-3">View more > </a>
                </div>
            </div>

            <div class="dashboard-profile-container">
                    <div class="quest-dashboard p-4">
                        <div class="d-flex quest-dashboard-title">
                            <img src="{{ asset('images/home.png')}}" alt="house" style="width: 2.5rem; height: auto;">
                            <h3 class="m-2">Dashboard</h3>
                        </div>
                        <div class="d-flex" style="gap: 1rem;">
                            <div class="quest-dashboard-bg1">
                                <h4>About Quest</h4>
                                <h3><img src="{{ asset('images/crown_01_gold_red 1.png')}}">TOP3 RANKING</h3>

                                <div class="ranking-content-wrapper">
                                    {{-- @foreach ($rankingCreators as $index => $creator)
                                     
                                    <div class="ranking-content">
                                        <div class="top3-image">
                                            @if ($index == 0)
                                                <img src="{{ asset('images/ingot_gold 1.png')}}" alt="gold">
                                            @elseif ($index == 1)
                                                <img src="{{ asset('images/ingot_silver 1.png')}}" alt="silver">
                                            @elseif ($index == 2)
                                                <img src="{{ asset('images/ingot_copper 1.png')}}" alt="bronze">
                                            @else
                                                <div style="width: 3rem; height: 3rem;"></div>
                                            @endif
                                        </div>
                                        
                                        <div class="ranking-list">
                                            <a href="{{ route('questcreators.profile.view', ['id' => $creator->id]) }}">
                                                @if ($creator && $creator->creator_image)
                                                    <img src="{{ $creator->creator_image }}" alt="icon_image">
                                                @else  
                                                    <img src="{{ asset('images/User icon.png') }}" alt="icon_image">
                                                @endif
                                                <span class="ms-1">{{ $creator->creator_name }}</span> (<i class="fa-solid fa-star text-warning fa-1x"></i>{{ $creator->favorites_count }})
                                            </a>  
                                        </div>
                                    </div>
                                    @endforeach --}}
                                </div>
                            </div>
                            <div class="quest-dashboard-bg2">
                                <h4>About Quest Creator</h4>
                                <div class=favorite-count-container>
                                    <div class="favorite-count">
                                        <p>The number of learner who register you as favorite Creator</p>
                                        @isset($favoriteCount)
                                            <h1>{{ $favoriteCount }}</h1>
                                        @else
                                            <h1>no data</h1>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="quest-management p-4">
                        <div class="d-flex">
                            <img src="{{ asset('images/shield_kiteshield_01_blue 2.png')}}" alt="house" style="width: 2.5rem; height: auto;">
                            <h3 class="m-2">Quest Management</h3>
                        </div>
                        <div class="quest-manegement-container position-relative">
                            <div class="quest-management-bg1 m-1">
                                <h4>Quests:{{ $questCount }}</h4>
                            </div>
                            <div class="quest-management-bg2 m-1">
                                <h4>Public Quests:</h4>
                                <h4>Private Quests:</h4>
                            </div>
                            <img src="{{ asset('images/castle.png')}}" class="position-absolute z-index-0" style="width: 30%; height: auto; right: 0; top: -50px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
            
    
@endsection
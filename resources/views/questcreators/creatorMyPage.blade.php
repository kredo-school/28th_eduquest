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
                    <h3 class="creator-name fs-2 mx-auto m-3">{{ $questcreator->creator_name}}</h3>
                </div>
                <div class="creator-profile-image">
                    <img src={{ $questcreator->creator_image }} alt="Creator Example" class="creator-avatar my-3">
                </div>
                <div class="job-title m-3">
                    <p>Job title:</p>
                    <p class="fs-5">{{ $questcreator->job_title}}</p>
                </div>
                <div class="Qualification m-3">
                    <p>Qualification:</p>
                    <p class="fs-5">{{ $questcreator->qualifications}}</p>
                </div>
                <div class="Introduction m-3">
                    <p>Introduction:</p>
                    <p class="fs-5">{{ $questcreator->description}}</p>
                </div>
                <div class="sns-links text-center fs-3 p-2">
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>About Quest</h4>
                                    <!-- ランキングの種類を切り替えるドロップダウン -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="rankingDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ranking:
                                            @if ($sort === 'started')
                                                Started
                                            @elseif ($sort === 'completed')
                                                Completed
                                            @elseif ($sort === 'watchlater')
                                                Watch Later
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="rankingDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('questcreators.creatorMyPage', ['sort' => 'started']) }}">
                                                    Started Ranking
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('questcreators.creatorMyPage', ['sort' => 'completed']) }}">
                                                    Completed Ranking
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('questcreators.creatorMyPage', ['sort' => 'watchlater']) }}">
                                                    Watch Later Ranking
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <h3>
                                    <img src="{{ asset('images/crown_01_gold_red 1.png') }}"> TOP3 RANKING
                                </h3>
                            
                                <div class="ranking-content-wrapper">
                                    @foreach ($rankingQuests as $index => $quest)
                                        <div class="ranking-content">
                                            <div class="top3-image">
                                                @if ($index == 0)
                                                    <img src="{{ asset('images/ingot_gold 1.png') }}" alt="gold" style="width: 3rem; height: 3rem;">
                                                @elseif ($index == 1)
                                                    <img src="{{ asset('images/ingot_silver 1.png') }}" alt="silver" style="width: 3rem; height: 3rem;">
                                                @elseif ($index == 2)
                                                    <img src="{{ asset('images/ingot_copper 1.png') }}" alt="bronze" style="width: 3rem; height: rem;">
                                                @else
                                                    <div style="width: 3rem; height: 3rem;"></div>
                                                @endif
                                            </div>
                                            
                                            <div class="ranking-list">
                                                <!-- 例としてクエスト詳細ページへのリンク -->
                                                <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}" style="font-size: 1rem;">
                                                    <!-- クエスト画像（存在しなければデフォルト画像を表示） -->
                                                    <img src="{{ $quest->thumbnail }}" alt="quest_image" style="width: 4rem; height: 3rem; border-radius: 0%;">
                                                    <span class="ms-1">{{ $quest->quest_title }}</span>
                                                    ({{ $quest->ranking_value }})
                                                </a>  
                                            </div>
                                        </div>
                                    @endforeach
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
                        <div class="quest-manegement-container">
                            <div class="quest-management-bg1 m-1">
                                <h4>Quests:{{ $questCount }}</h4>
                            </div>
                            <div class="quest-management-bg2 m-1">
                                <h4>Saved Quests:{{ $watchLaterCount }}</h4>
                            </div>
                            <a href="{{ route('quests.index')}}">
                                <img src="{{ asset('images/castle-image.png') }}" class="bg-image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
            
    
@endsection
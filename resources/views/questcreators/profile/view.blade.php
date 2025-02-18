@extends('layouts.app')

@section('title', 'Creator Mypage')

@section('content')
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
                        <img src={{ $questcreator->creator_image }} alt="Creator Example" class="creator-avatar my-3">
                        <div class="sns-links text-center fs-3 p-3">
                            <a href="{{ $questcreator->youtube}}" class="{{ $questcreator->youtube ? 'text-danger' : 'text-secondary' }}"><i class="bi bi-youtube mx-3"></i></a>
                            <a href="{{ $questcreator->x_twitter}}"  class="{{ $questcreator->x_twitter ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-twitter-x mx-3"></i></a>
                            <a href="{{ $questcreator->facebook}}" class="{{ $questcreator->facebook ? 'text-primary' : 'text-secondary' }}"><i class="bi bi-facebook mx-3"></i></a>
                            <a href="{{ $questcreator->linkedin}}" class="{{ $questcreator->linkedin ? 'text-dark' : 'text-secondary' }}"><i class="bi bi-linkedin mx-3"></i></a>
                        </div>
                        
                        {{-- 編集ボタン (role_id 2 の場合のみ表示) --}}
                        @if($user && $user->role_id == 2 && $user->id == $questcreator->user_id)
                        <div class="creator-edit-button text-center p-3">
                            <a href="{{ route('questcreators.profile.edit', ['id' => $questcreator->id]) }}" class="text-decoration-none fs-3">
                                Edit
                            </a>
                        </div>
                        @endif

                        {{-- 現在のユーザーが他のプロフィールページを表示している場合のみお気に入りボタンを表示 --}}
                        @if($user && $user->id !== $questcreator->user_id)
                        <div class="favorite-button text-center p-3">
                            @if ($user->favoriteCreators->contains($questcreator))  {{-- お気に入りに登録されている場合 --}}
                                <form action="{{ route('favorites.destroy', $questcreator->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn fs-3"><i class="fa-solid fa-star text-warning fa-2x"></i> Unfavorite</button>
                                </form>
                            @else  {{-- お気に入り未登録状態の場合 --}}
                                <form action="{{ route('favorites.store', $questcreator->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn fs-3"><i class="fa-regular fa-star fa-2x"></i> Favorite</button>
                                </form>
                            @endif
                        </div>
                        @endif
                </div>

                
                <div class="creator-profile-view col-8 p-4 d-flex flex-column">
                    {{-- Main Profile --}}
                    <div class="bg-light border border-black rounded h-100 w-100 px-2">
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

                    {{-- Creator's Quests --}}
                    <div class="my-4">
                        <h2>
                            <img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">
                            This Creator's Quests
                        </h2>

                        <div class="horizontal-scroll quests-row px-3">
                            @forelse ($questcreator->quests as $quest)
                                <div class="card quest-item mx-1" style="width: 200px;">
                                    <!-- 1) Thumbnail -->
                                    @if ($quest->thumbnail)
                                        <div class="aspect-ratio-16-9">
                                            <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                                <div class="aspect-ratio-16-9-inner">
                                                    <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail">
                                                </div>
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}">
                                            <div class="aspect-ratio-16-9 no-image-box">
                                                <span class="no-image-text-center">No Image</span>
                                            </div>
                                        </a>
                                    @endif

                                    <!-- 2) Quest Title + Red Flag Icon -->
                                    @php
                                        $record = Auth::user()->userQuests
                                            ->where('quest_id', $quest->id)
                                            ->first();
                                        $status = $record ? $record->status : null;
                                    @endphp

                                    <div class="d-flex justify-content-between align-items-center px-2 mt-2">
                                        <!-- タイトル -->
                                        <a href="{{ route('quests.chapters', ['id' => $quest->id]) }}"
                                        class="text-dark text-decoration-none">
                                        <span>{{ $quest->quest_title }}</span>
                                        </a>

                                        <!-- Watch Later アイコン (status別) -->
                                        @if (is_null($status))
                                            {{-- status=null → 透明旗を表示、クリックしたらWatchLater=0登録 --}}
                                            <form action="{{ route('watch.later.toggle', $quest->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-light" style="border:none;">
                                                    <img src="{{ asset('images/flag_transparent.png') }}" alt="flag_transparent" class="flag_transparent">
                                                </button>
                                            </form>
                                        @elseif ($status == 0)
                                            {{-- status=0(WatchLater) → 赤旗を表示、クリックでトグルOFF(削除) or InProgressへ変更 --}}
                                            <form action="{{ route('watch.later.toggle', $quest->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-light" style="border:none;">
                                                    <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                                                </button>
                                            </form>
                                        @elseif ($status == 1)
                                            {{-- status=1(InProgress) → 赤旗固定(クリック不可) --}}
                                            <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                                        @elseif ($status == 2)
                                            {{-- status=2(Completed) → 赤旗固定(クリック不可) --}}
                                            <img src="{{ asset('images/flag_red.png') }}" alt="flag_red" class="flag_green">
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p>No quests created by this creator yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    


            
    
@endsection
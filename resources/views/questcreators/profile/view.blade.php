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
                        <div class="text-center p-3" >
                            <a href="{{ route('questcreators.profile.edit', ['id' => $questcreator->id] )}}" class="edit-button-container text-decoration-none fs-3">Edit</a>
                        </div>
                </div>

                {{-- Main Profile --}}
                <div class="creator-profile-view col-8 p-4 d-flex flex-column">
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
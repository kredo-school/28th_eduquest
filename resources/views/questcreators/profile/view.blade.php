@extends('layouts.app')
@section('title', 'Creator Profile')
@section('content')

<div class="row">
    <div class="col-8">
        {{-- Title --}}
        <div class="text-start mb-5 d-flex align-items-center">
            <img src="{{ asset('images/madoshi_02_green.png') }}" alt="Icon" class="me-2 title-icon">
            <h2 class="m-0">Creator Profile</h2>
        </div>

        {{-- Profile Content --}}
        <div class="mb-4">
            <!-- Profile Image -->
            <div class="mb-3 d-flex align-items-center">
                <label class="col-sm-3">Profile Image</label>
                <div class="col-sm-6 text-center">
                    <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: auto; border: 2px solid #ccc;">
                        <img src="{{ $creator->creator_image ?? asset('images/default-profile.png') }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Creator Information -->
            <div class="row mb-3">
                <label class="col-sm-3">Name</label>
                <div class="col-sm-9">
                    <p class="mb-0">{{ $creator->creator_name ?? 'Not set' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3">Job Title</label>
                <div class="col-sm-9">
                    <p class="mb-0">{{ $creator->job_title ?? 'Not set' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3">Qualification</label>
                <div class="col-sm-9">
                    <p class="mb-0">{{ $creator->qualification ?? 'Not set' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3">Description</label>
                <div class="col-sm-9">
                    <p class="mb-0">{{ $creator->description ?? 'Not set' }}</p>
                </div>
            </div>

            <!-- SNS Links -->
            <div class="row mb-3">
                <label class="col-sm-3">SNS Links</label>
                <div class="col-sm-9">
                    <div class="d-flex gap-3">
                        @if($creator->youtube)
                            <a href="{{ $creator->youtube }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-youtube"></i>
                            </a>
                        @endif
                        @if($creator->facebook)
                            <a href="{{ $creator->facebook }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-facebook"></i>
                            </a>
                        @endif
                        @if($creator->x_twitter)
                            <a href="{{ $creator->x_twitter }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                        @endif
                        @if($creator->linkedin)
                            <a href="{{ $creator->linkedin }}" target="_blank" class="text-decoration-none">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Button -->
        <div class="text-center mt-4">
            <a href="{{ route('questcreators.profile.edit') }}" class="custom-btn">Edit Profile</a>
        </div>
    </div>
</div>
@endsection 
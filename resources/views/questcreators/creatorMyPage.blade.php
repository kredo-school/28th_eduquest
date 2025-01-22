@extends('layouts.app')
@section('title', 'Creator Profile')
@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Quest Creator Profile</h1>

    <div class="row">
        <!-- 左カラム（画像と基本情報） -->
        <div class="col-md-4 text-center">
            <!-- プロフィール画像 -->
            <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: auto; border: 2px solid #ccc;">
                <img src="{{ $creator->creator_image }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <h3 class="mt-3">{{ $creator->creator_name }}</h3>
            <p class="text-muted">{{ $creator->job_title }}</p>
        </div>

        <!-- 右カラム（詳細情報） -->
        <div class="col-md-8">
            <div class="mb-3">
                <h4>Description</h4>
                <p>{{ $creator->description }}</p>
            </div>
            <div class="mb-3">
                <h4>Qualifications</h4>
                <p>{{ $creator->qualification }}</p>
            </div>
            <div class="mb-3">
                <h4>SNS Links</h4>
                <ul>
                    @if($creator->youtube)
                        <li><a href="{{ $creator->youtube }}" target="_blank">YouTube</a></li>
                    @endif
                    @if($creator->facebook)
                        <li><a href="{{ $creator->facebook }}" target="_blank">Facebook</a></li>
                    @endif
                    @if($creator->x_twitter)
                        <li><a href="{{ $creator->x_twitter }}" target="_blank">X (Twitter)</a></li>
                    @endif
                    @if($creator->linkedin)
                        <li><a href="{{ $creator->linkedin }}" target="_blank">LinkedIn</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

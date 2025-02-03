@extends('layouts.app')

@section('title', 'Creator Mypage')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4 regulation">
        <h2 class="mb-3">Regulations for Edu Quest Creators</h2>
        <ol class="list-group list-group-numbered">
            <li class="list-group-item border-0">
                <strong>General Overview</strong>
                <p>In Edu Quest, creators are required to upload Quest materials (videos). Players can freely watch and learn from the uploaded Quests.</p>
            </li>
            <li class="list-group-item border-0">
                <strong>Rules for Creating Quest Materials</strong>
                <ul class="list-group">
                    <li class="list-group-item  border-0">Each video should be between 5 minutes and 60 minutes in length.</li>
                    <li class="list-group-item  border-0">Ensure high-quality recording (at least 720p resolution).</li>
                    <li class="list-group-item  border-0">The audio should be clear, with minimal background noise.</li>
                    <li class="list-group-item  border-0">Include a brief greeting and an overview of the Quest at the beginning of each video.</li>
                </ul>
            </li>
            <li class="list-group-item border-0">
                <strong>Prohibited Actions</strong>
                <ul class="list-group border-0">
                    <li class="list-group-item border-0">Copyright infringement is strictly prohibited.</li>
                    <li class="list-group-item border-0">Content that violates public order and morality or contains discriminatory or offensive expressions is not allowed.</li>
                </ul>
            </li>
        </ol>
        <div class="text-center mt-3">
            <a href="{{ route('questcreators.creatorMyPage', ['id' => $id]) }}" class="agree-btn">I agree</a>
        </div>
    </div>
</body>

<style>
    .regulation {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        padding-left: 100px;
    }

    .agree-btn{
        background-color: #588157;
        color: white;
        border: none;
        padding: 10px 40px;
        display: block;
        margin: 30px auto;
        text-decoration: none;
        width: 250px;
    }
</style>

@endsection
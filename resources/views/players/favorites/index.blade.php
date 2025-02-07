@extends('layouts.app')

@section('content')

<div class="scroll-container2">
    <img src="../images/RPG Bar Icon.png" alt="">
    <div class="overlay2">
        <p>Favorite Quest Creator List</p>
    </div>
</div>

<div class="favorite-creator-container">
    @foreach($favoriteCreators as $creator)
    <div class="favorite-creator-list">
        <div>
            @if(!empty($creator->profile_image))
                <img src="{{ $creator->profile_image }}" alt="">
            @else
                <img src="{{ asset('../images/User icon.png') }}" alt="icon_image">
            @endif
        </div>
        <div>
            <p>Teacher {{ $creator->creator_name }}</p>
            <p>Job Title: {{ $creator->job_title }}</p>
            <p>Last Updated: {{ $creator->updated_at->format('Y/m/d') }}</p>
        </div>
    </div>
        <div class="btn-delete-container">
            <form action="{{ route('favorites.destroy', $creator->id )}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Delete<img src="../images/image 85.png" alt="delete button" style="width: 1.5rem; height: auto; margin-left: 0.5rem"></button>
            </form>
        </div>
    @endforeach
</div>

@endsection

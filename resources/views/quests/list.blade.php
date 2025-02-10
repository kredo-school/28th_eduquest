@extends('layouts.app')
@section('title', 'Quest List')
@section('content')

<div class="container">
    <div class="header">
        <div class="title-container ms-0">
            <img src="{{ asset('images/Group 274.png') }}" alt="Title Icon" class="title-icon">
            <h2>Created Quest List</h2>
        </div>
        <a href="{{ route('quests.create')}}" class="btn btn-create">
            Create New Quest
            <img src="{{ asset('images/38.png') }}" alt="Create Icon">
        </a>
    </div>

    <div class="quest-list">
        @foreach($quests as $quest)
            <div class="quest-list-container">
                <a href="{{ route('quests.index', ['id' => $quest->id]) }}">
                    <div class="quest-info">
                        <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail">
                        <div class="quest-details">
                            <h3>{{ $quest->quest_title }}</h3>
                            <p class="update-date">Last Updated: {{ $quest->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </a>
                <div class="quest-actions">
                    <a href="{{ route('quests.edit', ['id' => $quest->id]) }}" class="btn btn-edit">
                        Edit
                        <img src="{{ asset('images/edit-icon.png') }}" alt="Edit Icon">
                    </a>
                    {{-- delete --}}
                    <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete-quest{{ $quest->id }}">
                        Delete
                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete Icon" class="delete-icon">
                    </button>
                    @include('quests.modals.delete')
                </div>
            </div>
        @endforeach
        
    </div>
</div>



@endsection
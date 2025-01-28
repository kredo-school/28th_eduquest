@extends('layouts.app')
@section('title', 'View All Quests')
@section('content')

<div class="container">
    <h2>Created Quest List</h2>
    <div class="quest-list">
        @foreach($quests as $quest)
            <div class="quest-item">
                <div class="quest-info">
                    <img src="{{ asset($quest->thumbnail) }}" alt="Quest Thumbnail">
                    <div class="quest-details">
                        <h3>{{ $quest->quest_title }}</h3>
                        <p class="update-date">最終更新日: {{ $quest->updated_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
                <div class="quest-actions">
                    <a href="#" class="btn btn-edit">
                        <img src="{{ asset('images/edit-icon.png') }}" alt="Edit Icon">Edit
                    </a>
                    {{-- delete --}}
                    <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete-quest{{ $quest->id }}">
                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete Icon" class="delete-icon">Delete
                    </button>
                    @include('quests.modals.delete')
                </div>
            </div>
        @endforeach
    </div>
</div>


<style>
.quest-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin: 20px;
}

.quest-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.quest-info {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.quest-info img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

.update-date {
    color: #666;
    font-size: 0.9rem;
    margin-top: 4px;
}

.quest-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 2px solid #000;
    background-color: #fff;
    color: #000;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 2px 2px 0 #000;
    transition: transform 0.1s;
    width: 150px;
}

.btn img {
    margin-left: 0.5rem;
    width: 30px;
    height: 30px;
    object-fit: contain;
}

.btn-edit {
    background-color: #fff;
}

.btn-delete {
    background-color: #fff;
}

.delete-icon{
    height: 20px;
    width: 20px;
}

.btn:hover {
    transform: translateY(-2px);
}
</style>


@endsection
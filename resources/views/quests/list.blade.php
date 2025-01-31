@extends('layouts.app')
@section('title', 'View All Quests')
@section('content')
<style>
    .custom-icon {
    color: #80ae80; /* 薄い黄緑色 */
    display: flex;
    justify-content: center;
    align-items: center;
    }

</style>

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
            <div class="quest-item">
                <a href="{{ route('quests.index', $quest->id) }}">
                    <div class="quest-info">
                        <img src="{{ $quest->thumbnail }}" alt="Quest Thumbnail">
                        <div class="quest-details">
                            <h3>{{ $quest->quest_title }}</h3>
                            <p class="update-date">Last Updated: {{ $quest->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </a>
                <div class="quest-actions">
                    <a href="{{ route('quests.edit', $quest->id) }}" class="btn btn-edit">
                        Edit
                        <img src="{{ asset('images/Green Slime.png') }}" alt="Edit Icon">
                    </a>
                    {{-- delete --}}
                    <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete-quest{{ $quest->id }}">
                        Delete
                        <img src="{{ asset('images/Red Slime.png') }}" alt="Delete Icon" class="delete-icon">
                    </button>
                    @include('quests.modals.delete')
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- 削除確認用のJavaScript -->
<script>
function confirmDelete(questId) {
    if (confirm('本当にこのクエストを削除してもよろしいですか？')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/quests/${questId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

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
    width: 160px;
    height: 90px;
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
    flex-direction: column;
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

.btn:hover {
    transform: translateY(-2px);
}

.header {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 1rem;
}

.title-container {
    display: flex;
    align-items: center;
    left: 0;
    padding-left: 1rem;
}


.btn-create {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.7rem 1.5rem;
    font-size: 1.1rem;
    border-radius: 20px;
    border: 2px solid #000;
    background-color: #fff;
    color: #000;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 2px 2px 0 #000;
    transition: transform 0.1s;
    width: 250px;
    text-align: center;
}

.btn-create img {
    margin-left: 0.5rem;
    width: 30px;
    height: 30px;
}

.btn-create:hover {
    transform: translateY(-2px);
}

body {
    font-family: 'DotGothic16', sans-serif;
}

.quest-item a {
    text-decoration: none;
    color: inherit;
}
</style>


@endsection
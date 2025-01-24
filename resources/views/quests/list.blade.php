@extends('layouts.app')
@section('title', 'View All Quests')
@section('content')

<div class="container">
    <h2>Created Quest List</h2>
    <div class="quest-list">
        @foreach($quests as $quest)
            <div class="quest-item">
                <div class="quest-info">
                    <img src="{{ $quest->image_path }}" alt="Quest Image">
                    <div class="quest-details">
                        <h3>{{ $quest->title }}</h3>
                        <p>{{ $quest->description }}</p>
                    </div>
                </div>
                <div class="quest-actions">
                    <a href="#" class="btn btn-edit">Edit</a>
                    <button class="btn btn-delete" onclick="confirmDelete({{ $quest->id }})">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- 削除確認モーダル -->
<script>
function confirmDelete(questId) {
    if (confirm('本当にこのクエストを削除してもよろしいですか？')) {
        // 削除用のフォームを作成して送信
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
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 0.5rem;
}

.btn-edit {
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
}

.btn-delete {
    background-color: #f44336;
    color: white;
    border: none;
}
</style>


@endsection
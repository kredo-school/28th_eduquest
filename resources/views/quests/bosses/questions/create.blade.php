@extends('layouts.app')

@section('title', 'Create The Boss')

@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container">
    <div class="row">
        <div class="col-7">
            <h2 class="mb-4">
                Create Boss for "{{ $quests->quest_title}}"
            </h2>
            <form method="POST" action="#">
                @csrf
                <div class="profile-title-s m-3">
                    <label for="description">Description</label>
                    <input type="text" name="description" required>
                </div>
                <div class="profile-title-s m-3">
                    <label for="passing_score">Passing_score</label>
                    <input type="number" name="passing_score" required>
                </div>
                <label class="mt-5">確認してCreateボタンを押して作成を完了してください。</label>
                <button type="submit" class="edit-button-container mx-3">Create</button>
            </form>

        </div>
    </div>
</div>
@endsection

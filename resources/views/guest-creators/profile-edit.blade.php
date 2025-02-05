@extends('layouts.app')

@section('content')
<div class="container">
    <h1>プロフィール編集</h1>
    <div class="profile-edit-form">
        <form method="POST" action="{{ route('questcreators.profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $creator->name) }}">
            </div>

            <div class="form-group">
                <label for="bio">自己紹介</label>
                <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $creator->bio) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</div>
@endsection 
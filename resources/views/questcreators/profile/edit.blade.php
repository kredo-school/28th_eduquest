@extends('layouts.app')

@section('title', 'Edit Profile for Quest Creator')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

{{-- 1　Icon + Account Menu --}}
<div class="row">
    {{-- Form --}}
    <div class="col-8">
        <form action="{{ route('questcreator.update', ['id' => $questcreator->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="redirect_to" value="{{ route('questcreators.profile.view', ['id' => $questcreator->id]) }}">
            {{-- Title --}}
            <div class="text-start mb-5 d-flex align-items-center">
                <img src="{{ asset('./images/character_madoshi_01_green.png') }}" alt="Icon" class="me-2 title-icon">
                <h2 class="m-0">Edit Profile</h2>
            </div>
            {{-- creator image --}}
            <!-- Display Profile Image -->
            <div class="mb-3 d-flex align-items-center">
                <label for="image" class="col-sm-3 form-label">Profile Image</label>
                <div class="col-sm-6 text-center mb-3">
                    <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: auto; border: 2px solid #ccc;">


                        <img id="preview-image" src="{{ $questcreator->creator_image ?? asset('images/default-profile.png') }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
            <!-- Upload New Image -->
            <div class="mb-3 text-center" style="max-width: 300px; margin: auto;">
                <div class="custom-file">
                    <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1 custom-file-input" aria-describedby="avatar-info" onchange="previewImage(this);" style="display: none;">
                    <label class="btn btn-outline-secondary mt-1" for="image">Select Image</label>
                </div>
                @error('creator_image')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
            </div>
             <!-- Input Fields -->
            <div class="row mb-3 me-5">
                <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="creator_name" name="creator_name" value="{{ old('creator_name', $questcreator->creator_name ?? '') }}" placeholder="Enter your name">
                </div>
            </div>
            <div class="row mb-3 me-5">
                <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $questcreator->job_title ?? '') }}" placeholder="Enter job title">
                </div>
            </div>
            <div class="row mb-3 me-5">
                <label for="qualification" class="col-sm-3 col-form-label">Qualification</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications" name="qualifications" value="{{ old('qualifications', $questcreator->qualifications ?? '') }}">
                </div>
            </div>
            <div class="row mb-3 me-5">
                <label for="description" class="col-sm-3 col-form-label">Introduction</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control textarea" name="description" id="description" rows="3" placeholder="Write a brief introduction" value="{{ old('description', $questcreator->description ?? '') }}">
                </div>
            </div>
            <div class="row mb-3 me-5">
                <div class="mb-3">
                    <div class="d-flex gap-3">
                        <div class="mb-3 row align-items-center">
                            <!-- 左側のラベル -->
                            <label for="snsLinks" class="col-sm-3 col-form-label">SNS Links</label>
                            <!-- 右側の入力フォーム -->
                            <div class="col-sm-9">
                                <div class="d-flex gap-3">
                                <!-- YouTube -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-youtube"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="youtube" name="youtube" placeholder="YouTube link" value="{{ old('youtube', $questcreator->youtube ?? '') }}">
                                </div>
                                <!-- Facebook -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-facebook"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="facebook" name="facebook" placeholder="Facebook link" value="{{ old('facebook', $questcreator->facebook ?? '') }}">
                                </div>
                                <!-- X -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                       <i class="bi bi-twitter-x"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="x_twitter" name="x_twitter" placeholder="X link" value="{{ old('x_twitter', $questcreator->x_twitter ?? '') }}">
                                </div>
                                <!-- LinkedIn -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-linkedin"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="linkedin" name="linkedin" placeholder="LinkedIn link" value="{{ old('linkedin', $questcreator->linkedin ?? '') }}">
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- Register Button -->
            <div class="text-center mt-4">
                <button type="submit" class="edit-button-container fs-3">Update</button>
                <button type="button" class="edit-button-container fs-3" onclick="window.location.href='{{ route('questcreators.profile.view', ['id' => $questcreator->id]) }}'">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
@extends('layouts.app')

@section('title', 'Switch to Quest Creator')

@section('content')
   
<div class="row align-items-start">
    
    @include('players.mypage.accountmenu.accountmenu')

    {{-- Form --}}
    <div class="col-8 ms-5">
        @auth
        @if ( auth()->user()->role_id === 0 || auth()->user()->role_id === 1)
                <form action="{{ route('questcreator.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    {{-- Title --}}
                    <div class="text-start mb-5 d-flex align-items-center">
                        <img src="{{ asset('images/ie.png') }}" alt="Icon" class="me-2 title-icon">
                        <h2 class="m-0">Quest Creator’s Public Profile</h2>
                    </div>
                    {{-- creator image --}}
                    <!-- Display Profile Image -->
                    <div class="mb-3 d-flex align-items-center">
                        <label for="image" class="col-sm-3 form-label">Creator Image</label>
                        <div class="col-sm-6 text-center mb-3">
                            <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: auto; border: 2px solid #ccc;">
                                <img src="{{ $creator->creator_image ?? asset('images/default-profile.png') }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    <!-- Upload New Image -->
                    <div class="mb-3 text-center" style="max-width: 300px; margin: auto;">
                        <label for="image" class="form-label">Upload Creator Image</label>
                        <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                        @error('creator_image')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Input Fields -->
                    <div class="row mb-3 me-5">
                        <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="creator_name" name="creator_name" placeholder="Enter your name">
                        </div>
                    </div>
                    <div class="row mb-3 me-5">
                        <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter job title">
                        </div>
                    </div>
                    <div class="row mb-3 me-5">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Write a brief introduction"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 me-5">
                        <label for="qualification" class="col-sm-3 col-form-label ">Qualification</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications" name="qualification">
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
                                            <input type="text" class="form-control border-start-0" id="youtube" name="youtube" placeholder="YouTube link">
                                        </div>
                                        <!-- Facebook -->
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-facebook"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" id="facebook" name="facebook" placeholder="Facebook link">
                                        </div>
                                        <!-- Instagram -->
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-instagram"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" id="x_twitter" name="x_twitter" placeholder="X link">
                                        </div>
                                        <!-- LinkedIn -->
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="bi bi-linkedin"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0" id="linkedin" name="linkedin" placeholder="LinkedIn link">
                                        </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- Register Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="custom-switch-btn">Register</button>
                    </div>
                </form>
            @else
                <h2 class="text-start mt-5">
                    <img src={{ asset('images/slime_purple.png') }} alt="purple_slime" class="slime">
                    You already have a Creator account.
                    <img src={{ asset('images/slime_purple.png') }} alt="purple_slime" class="slime">
                </h2>
            @endif
    </div>    
    @endauth

</div>
@endsection
@extends('layouts.app')
@section('title', 'Switch to Quest Creator')
@section('content')
<div class="row text-center">
    {{-- Icon + Account Menu --}}
    <div class="col-3 bg-warning">
        <h2>   Icon + Account Menu   </h2>
    </div>
    {{-- Form --}}
    <div class="col-9">
        <form action="{{ route('questcreator.store') }}" method="post" enctype="multipart/form-data">
        @csrf
    
            <h2>Quest Creator’s Public Profile</h2>
            {{-- creator image --}}
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Profile Image</label>
                <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                        @error('creator_image')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
            </div>
             <!-- Input Fields -->
            <div class="row mb-3">
                <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="creator_name" name="creator_name" placeholder="Enter your name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter job title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Write a brief introduction"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="qualification" class="col-sm-3 col-form-label ">Qualification</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications" name="qualification">
                </div>
            </div>
            <div class="row mb-3">
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
                <button type="submit" class="btn btn-success px-5">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
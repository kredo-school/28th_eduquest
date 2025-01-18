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
        <form action="{{ route('questcreator.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <h2>Quest Creator’s Public Profile</h2>
            {{-- creator image --}}
            <div class="mb-3">
                <label for="image" class="form-label fw-bold">Profile Image</label>
                <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                        @error('avatar')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
            </div>
             <!-- Input Fields -->
            <div class="row mb-3">
                <label for="first_name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="creator_name" placeholder="Enter your name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jobTitle" name="job_title" placeholder="Enter job title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-3 col-form-label">Introduction</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Write a brief introduction"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="qualification" class="col-sm-3 col-form-label ">Qualification</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="qualification" name="qualifications" placeholder="Enter your qualifications">
                </div>
            </div>

            <div class="row mb-3">
                
                <div class="mb-3">
                    <div class="d-flex gap-3">
                        <label for="snsLinks" class="col-sm-3 form-label">SNS Links</label>
                            <div class="col-sm-9">
                                <!-- YouTube -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-youtube"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="youtubeLink" name="youtube" placeholder="YouTube link">
                                </div>
                                <!-- Facebook -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-facebook"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="facebookLink" name="facebook" placeholder="Facebook link">
                                </div>
                                <!-- Twitter -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-instagram"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="x_twitterLink" name="x_twitter" placeholder="x_twitter link">
                                </div>
                                <!-- LinkedIn -->
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-linkedin"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="linkedinLink" name="linkedin" placeholder="LinkedIn link">
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
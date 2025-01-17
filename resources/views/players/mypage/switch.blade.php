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
        <form action="xxxx" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                </div>
            </div>

            <div class="row mb-3">
                <label for="job_title" class="col-sm-3 col-form-label">Job Title</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="Enter job title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="introduction" class="col-sm-3 col-form-label">Introduction</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="introduction" rows="3" placeholder="Write a brief introduction"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="qualification" class="col-sm-3 col-form-label ">Qualification</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications">
                </div>
            </div>
            <div class="row mb-3">
                <label for="snslink" class="col-sm-3 col-form-label">SNS Link</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="facebook" placeholder="Enter your SNS">
                    
                </div>
                <div class="mb-3">
                    <label for="snsLinks" class="form-label">SNS Links</label>
                    <div class="d-flex gap-3">
                        <!-- YouTube -->
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-youtube"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" id="youtubeLink" name="youtubeLink" placeholder="YouTube link">
                        </div>
                
                    </div>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="linkedin" placeholder="Enter your SNS">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="twitter" placeholder="Enter your SNS">
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
@extends('layouts.app')
@section('title', 'Switch to Quest Creator')
@section('content')

<style>

 /* 1　左のバー */
 .side-bar{
            border: 2px solid #261C11;
            border-radius: 20px;
            font-size: 6px;
            margin-left: 30px;
        }
/* 2　剣持った画像の事 */
    .player-image{
        height: 100px;
        width: 100px;
        margin-top: 30px;
        margin-bottom: 15px;
    }
/* 3　ファイルを選択の下の2行の事 */
    .Accetable{
        font-size: 10px;
        line-height: 1.2; /* 行間を狭める */
        margin-bottom: 5px; /* パラグラフ間の余白も調整 */
        margin-top: 10px;
    }
/* 4　4つある剣の画像の事 */
    .sword{
        height: 40px;
        width: 40px;
    }
</style>
   
<div class="row text-center">






{{-- 1　Icon + Account Menu --}}
<div class="row text-center">
    <div class="side-bar col-2 bg-white">
{{-- 2 --}}
        <div>
            <img src="{{ asset('images/User icon.png')}}" alt="playerimage" class="player-image">
        </div>
        <div class="mb-3">
            <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                    @error('avatar')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror
{{-- 3 --}}
            <div class="Accetable" style="text-align: center">
                <p>Accetable formats:jpeg,jpg,png,gif only.</p>
                <p>Max file size: 1048kB</p>
            </div>
        </div>
{{-- 4 --}}
        <div style="text-align: left">
            <img src={{ asset('images/sword.png') }} alt="sword" class="sword">
            <a href="#" class="text-decoration-none fs-6 text-dark">Account Securlty</a>
        </div>
        <div style="text-align: left">
            <img src={{ asset('images/sword.png') }} alt="sword" class="sword">
            <a href="#" class="text-decoration-none fs-6 text-dark">About Us</a>
        </div>
        <div style="text-align: left">
            <img src={{ asset('images/sword.png') }} alt="sword" class="sword">
            <a href="#" class="text-decoration-none fs-6 text-dark">Switch to Quest Creator Account</a>
        </div>
        <div style="text-align: left">
            <img src={{ asset('images/sword.png') }} alt="sword" class="sword">
            <a href="#" class="text-decoration-none fs-6 text-dark">Delete My Account</a>
        </div>
    </div>








{{-- Form --}}
    <div class="col-9">
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
                <button type="submit" class="custom-btn">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
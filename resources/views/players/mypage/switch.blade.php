@extends('layouts.app')
@section('title', 'Switch to Quest Creator')
@section('content')

{{-- 元の背景色のベース --}}
<style>
    body{
        background-color:#FFFFF3;
        font-family: 'DotGothic16', sans-serif;
        color: #261C11;
    }

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
<body>

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
        <div class="col-8 justify-content-center">
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
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="jobTitle" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle" placeholder="Enter your job title">
                </div>
                <div class="mb-3">
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea class="form-control" id="introduction" rows="3" placeholder="Write a brief introduction"></textarea>
                </div>
                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications">
                </div>
                <div class="mb-3">
                    <label for="snsLinks" class="form-label">SNS Link</label>
                    <div class="d-flex">
                        <button type="button" class="btn btn-outline-secondary me-2">YouTube</button>
                        <button type="button" class="btn btn-outline-secondary me-2">Email</button>
                        <button type="button" class="btn btn-outline-secondary">Facebook</button>
                    </div>
                </div>
                <!-- Register Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
@endsection
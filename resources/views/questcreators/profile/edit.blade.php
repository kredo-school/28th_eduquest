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
            margin-bottom: 50px; /* 下の余白をなくす */
            display: flex;
            flex-direction: column; /* 縦方向に並べる */
            height: 100%; /* 高さを100%に調整 */
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

        body{
            background-color:#FFFFF3;
            font-family: 'DotGothic16', sans-serif;
            color: #261C11;
        }

        /* creator-profile */

        .creator-profile{
            background-color:#FFFFFF;
            border: 3px solid #588157;
            /*margin-right:10px;*/
        }
        .creator-name{
            font-size: 20px;
        }
        .creator-avator{
            display: block;
            margin:0 auto;
            border-radius: 50%;
            object-fit: cover;
            width: 200px;
            height: 200px;
            border: 3px solid #588157;

        }

        .profile-title-s{
            color: #646363;
            margin: 10px 0px;
        }

        .mute-text{
            font-size: 18px;
            color: #afafaf; 
        }

        .edit-button-container{
            text-decoration: none;
            color: #333;
            background: white;
            padding: 0.35rem 2.2rem;
            border: 1px solid #333;
            border-radius: 30px 30px 30px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .edit-button-container a {
            text-decoration: none;
            color: #333;
            background: white;
            padding: 0.35rem 2.2rem;
            border: 1px solid #333;
            border-radius: 30px 30px 30px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }


        /* quest-management */

        .quest-management{
            position: relative; 
            background-color: #FFFFFF;
            border: 3px solid #588157;
            margin-left:10px;
        }
        .quest-total{ 
            background-color: #C7D7AC;
            height: 100px;
            width: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .alphabet-q{
            height:40px;
            width:30px;
            margin-left: 20px;
            margin-right: 10px;
        }
        .alphabet-u{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-e{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-s{
            height:40px;
            width:30px;
            margin-right: 10px;
        }
        .alphabet-t{
            height:40px;
            width:30px;
            margin-right: 10px;
        }

        /* background-design */

        .red-dragon{
            position: absolute;
            width: 139px;
            height: 72px;
            bottom: 230px; 
            right: 300px;
            transform: rotate(-10deg);
            background-color: white;
            opacity:0.5;

        }
        .blue-castle{
            position: absolute;
            width: 200px;
            height: 310px;
            bottom: 30px;
            right: 130px;
            background-color: white;
            opacity:0.5;
        }
        .yama-1{
            position: absolute;
            width: 65px;
            height: 55px;
            bottom: 30px; 
            right: 60px;
            background-color: white;
            opacity:0.5;
        }
        .yama-2{
            position: absolute;
            width: 40px;
            height: 30px;
            bottom: 30px;
            right: 160px; 
            background-color: white;
            opacity:0.6;
        }

        .mgt-btn{
            position: absolute;
            border: 2px solid #261C11;
            background-color: #FFFFFF;
            border-radius:40px;
            bottom:80px;
            left:100px;
            padding: 10px 100px;
            font-size:30px;
            z-index: 1000;
        }
    </style>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </head>
   


{{-- 1　Icon + Account Menu --}}
<div class="row">
    {{-- Form --}}
    <div class="col-8">
        <form action="{{ route('questcreator.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="redirect_to" value="{{ route('questcreators.profile.view', ['id' => $questcreator->id]) }}">
            {{-- Title --}}
            <div class="text-start mb-5 d-flex align-items-center">
                <img src="{{ asset('images/madoshi_02_green.png') }}" alt="Icon" class="me-2 title-icon">
                <h2 class="m-0">Edit Profile</h2>
            </div>
            {{-- creator image --}}
            <!-- Display Profile Image -->
            <div class="mb-3 d-flex align-items-center">
                <label for="image" class="col-sm-3 form-label">Profile Image</label>
                <div class="col-sm-6 text-center mb-3">
                    <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: auto; border: 2px solid #ccc;">


                        <img id="preview-image" src="{{ $creator->creator_image ?? asset('images/default-profile.png') }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover;">
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
                    <input type="text" class="form-control" id="qualification" placeholder="Enter your qualifications" name="qualification" value="{{ old('qualification', $questcreator->qualification ?? '') }}">
                </div>
            </div>
            <div class="row mb-3 me-5">
                <label for="description" class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Write a brief introduction" value="{{ old('Description', $questcreator->Description ?? '') }}"></textarea>
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
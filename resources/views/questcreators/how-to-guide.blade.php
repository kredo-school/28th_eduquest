@extends('layouts.app')

@section('content')

<div class="guide-whole-container mt-5">
    <div class="guide-body">
        <div class="guide-title-container">
            <img src="{{ asset('images/Home Icon.png')}}" alt="">
            <h2>Dear Quest Creators</h2>
        </div>
        <div class="guide-content">
            <p>
                Thank you for joining us for Player's experience. <br>
                This is the first step to making your journey ahead more enjoyable and smooth. <br>
                Just like preparing your gear before setting out on adventure, reading this guide <br>
                will help you master the unique, game-like features and functionalities of Eduquest. <br>
                Together, let's create courses that inspire and challenge Players!
            </p>
        </div>
    </div>
    
    <div class="writer-guide">
        <div class="guide-container">
            <div class="box-container">
                <div class="box">W</div>
            </div>
            <div class="box-container">
                <div class="box">R</div>
            </div>
            <div class="box-container">
                <div class="box">I</div>
            </div>
            <div class="box-container">
                <div class="box">T</div>
            </div>
            <div class="box-container">
                <div class="box">E</div>
            </div>
            <div class="box-container">
                <div class="box">R</div>
            </div>
        </div>
        <div class="guide-container">
            <div class="box-container">
                <div class="box">G</div>
            </div>
            <div class="box-container">
                <div class="box">U</div>
            </div>
            <div class="box-container">
                <div class="box">I</div>
            </div>
            <div class="box-container">
                <div class="box">D</div>
            </div>
            <div class="box-container">
                <div class="box">E</div>
            </div>
        </div>
        <div class="guide-footer">
            <div class="guide-footer-container">
                <div class="guide-image-container">
                    <div class="guide-image">
                        <img src="../images/character_elf_woman_01_01_gold 1.png" alt="left image 1">
                    </div>
                    <div class="guide-image">
                        <img src="../images/User Icon 03.png" alt="left image 2">
                    </div>
                </div>
                <div class="go-link">
                    <a href="#">GO→</a>
                </div>
                <div class="guide-image">
                    <img src="../images/User Icon 04.png" alt="right image 1" style="width: 10vw;">
                </div>
                <div class="guide-image">
                    <img src="../images/character_yusha_woman_blue 1.png" alt="right image 2">
                </div>
            </div>
        </div>                        
    </div>
</div>

@endsection
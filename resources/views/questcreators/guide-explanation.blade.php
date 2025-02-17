@extends('layouts.app')

@section('content')

<div class="scroll-container">
    <img src="../images/RPG Bar Icon.png" alt="">
    <div class="overlay">
        <p>Choose a spot you like</p>
    </div>
</div>

<div class="guide-map">
    <img src="../images/Group 276.png" alt="">
    <div class="guide-map-link">
        <a href="#target-section1" class="over-lay-link1">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section2" class="over-lay-link2">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section3" class="over-lay-link3">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section4" class="over-lay-link4">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
        <a href="#target-section5" class="over-lay-link5">
            <img src="../images/Cancel.png" class="over-lay-image">
        </a>
    </div>
</div>

<div class="map-content">
    <div class="wizard">
        <div class="wizard-title" id="target-section3">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/character_madoshi_01_green 2.png" alt="">
            <h5>Enhance Your Instructor Profile</h5>
        </div>
        <div class="wizard-content">
            <p>
                Students will refer to this when evaluating your course.<br>
                Write in a way that shows you are trustworthy.<br>
                You can set a different profile picture for your instructor page than the one used on the learner’s public profile.<br>
                Promote yourself on social media so that people can get to know you better and become your fans.
            </p>
        </div>
    </div>

    <div class="shield">
        <div class="shield-title" id="target-section1">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/shield_kiteshield_01_blue 2.png" alt="">
            <h5>Create a Quest</h5>
        </div>
        <div class="shield-content">
            <p>
                Include a video and a description.<br>
                Divide your content into chapters.<br>
                If necessary, attach a PDF with supplementary information.
            </p>
        </div>
    </div>

    <div class="dragon">
        <div class="dragon-title" id="target-section4">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/character_monster_dragon_03_red.png" alt="" style="width: 9vw;">
            <h5>Create a Test</h5>
        </div>
        <div class="dragon-content">
            <p>
                Prepare a test at the end of your quest for students to earn a badge.
            </p>
        </div>

        <!-- Place the castle section within the dragon section -->
        <div class="castle">
            <div class="castle-gap">
                <div class="castle-title" id="target-section2">
                    <img src="../images/toride_brown_flag_yellow 1 (1).png" alt="">
                    <h5>Select the Badge for Players</h5>
                </div>
                <div class="castle-content">
                    <p>
                        Players will earn a badge upon defeating the Boss.<br>
                        Choose and configure a badge that perfectly suits your quest.<br>
                        Select one that fits the theme of your quest.
                    </p>
                </div>
            </div>
            <div class="badge-example">
                <p style="font-size: 1.5rem;">Example</p>
                <img src="../images/Frame 70.png" alt="badge-example">
            </div>
        </div>
    </div>

    <div class="house">
        <div class="house-title" id="target-section5">
            <img src="../images/mark_mappin 2.png" alt="">
            <img src="../images/ie.png" alt="">
            <h5>▼Dashboard</h5>
        </div>
        <div class="house-content">
            <ul>
                <li>Review feedback and student ratings.</li>
                <li>See how many students have viewed your course and added it to their favorites.</li>
                <li>Use these metrics to refine and improve your course.</li>
            </ul>
        </div>
    </div>
</div>

@endsection

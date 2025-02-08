@extends('layouts.app')

@section('title', 'FAQ / Contact')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">FAQ / Contact</h1>

    <!-- 検索バーの追加 -->
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <input type="text" placeholder="Search..." class="search-bar" style="width: 800px;">
    </div>

    <hr>
    <div class="faq-section">
        <h2>Frequently Asked Questions</h2>
        <ul>
            <li>Do you support inquiries by phone?</li>
            <li>and more...
            </li>
        </ul>
    </div>
    <div class="service-overview mt-5">
        <h2>Service Overview</h2>
        <ul>
            <li>What is EduQuest?</li>
            <li>and more...</li>
        </ul>
    </div>
    
    <div class="contact-form mt-5 text-center">
        <h3 class="text-center mb-5">If you cannot find a solution, please contact us here.</h3>
        <button class="btn btn-outline-secondary">Contact form</button>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'FAQ / Contact')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">FAQ / Contact</h1>

    <!-- 検索バーの追加 -->
    <div style="display: flex; justify-content: center; margin-top: 20px;">
        <input type="text" placeholder="Search..." class="search-bar" style="width: 800px;">
    </div>

    <!-- FAQの質問と回答を表示 -->
    <div style="margin-top: 20px;">
        @foreach($faqs as $faq)
            <div style="margin-bottom: 20px;">
                <p style="font-size: 1.2em;"><strong style="color: blue;">Q.</strong> {{ $faq->question }}</p>
                <p style="font-size: 1.2em;"><strong style="color: red;">A.</strong> {{ $faq->answer }}</p>
                <hr>
            </div>
        @endforeach
    </div>

    <!-- Contact section -->
    <div class="contact-form mt-2 text-center" style="border: 5px solid #fcbe23; padding: 5px; border-radius: 5px;">
        <h3 class="text-center mb-5">If you cannot find a solution, please contact us here.</h3>
        <button class="btn btn-outline-secondary" style="color: rgb(255, 162, 0);">Contact form</button>
    </div>
</div>
@endsection
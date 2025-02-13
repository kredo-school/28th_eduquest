@extends('layouts.app')

@section('title', 'FAQ / Contact')

@section('content')
<div class="mt-5">
    <h1 class="text-center mb-5">FAQ / Contact</h1>

    <!-- 検索バーの追加 -->
    <form method="GET" action="{{ url('/FAQ-Contact') }}" style="display: flex; justify-content: center; margin-top: 20px;">
        <input type="text" name="search" placeholder="Search..." class="search-bar" style="width: 800px;" value="{{ request('search') }}">
    </form>

    <!-- FAQの質問と回答を表示 -->
    <div class="container" style="margin-top: 20px;">
        @foreach($faqs as $faq)
            <div style="margin-bottom: 20px;">
                <p style="font-size: 1.2em;">
                    <strong style="color: blue;">Q.</strong> {!! str_replace(request('search'), '<span style="background-color: yellow;">'.request('search').'</span>', $faq->question) !!}
                </p>
                <p style="font-size: 1.2em;">
                    <strong style="color: red;">A.</strong> {!! str_replace(request('search'), '<span style="background-color: yellow;">'.request('search').'</span>', $faq->answer) !!}
                </p>
                <hr>
            </div>
        @endforeach
    </div>

    <!-- Contact section -->
    <div style="background-color: #ffeb3b; padding: 20px;">
        <div class="container text-center">
            <h3 class="text-center mb-5">If you cannot find a solution, please contact us here.</h3>
            <img src="..\images\character_yusha_01_green.png"
            alt="yusya_man" style="min-width: 25px; min-height: 25px; width: 
            25px; height: 25px; margin: 5px; object-fit: contain;">
            <button class="btn btn-outline-secondary">Contact form</button>
            <img src="..\images\character_yusha_woman_red.png" 
        alt="yusya_woman" style="width: 25px; height: 25px; margin: 5px;">
        </div>
    </div>
</div>
@endsection



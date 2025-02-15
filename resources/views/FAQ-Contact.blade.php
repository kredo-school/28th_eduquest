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
    <div style="border: 3px solid rgb(88,130, 87); padding: 20px; margin-top: 20px;">
        <div class="container text-center">
            <h3 class="text-center mb-3">If you cannot find a solution, please contact us here.</h3>
            <button class="btn btn-outline-secondary">
                Contact form
                <img src="{{ asset('images/te_yubisashi_right 3.png') }}" alt="arrow" style="width: 20px; height: 20px; margin-left: 5px;">
            </button>
        </div>
    </div>
</div>
@endsection
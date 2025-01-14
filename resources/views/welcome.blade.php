@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <header class="text-center py-5">
        <h1 class="display-4 fw-bold">ようこそ、あなたのアイデアを形に</h1>
        <p class="lead">ストーリー、アイデア、そして知識を共有する場所。</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">今すぐ始める</a>
    </header>

    <!-- Featured Content Section -->
    <section class="my-5">
        <h2 class="fw-bold mb-4">注目の記事</h2>
        <div class="row">
            
        </div>
    </section>

    <!-- Popular Topics Section -->
    <section class="my-5">
        <h2 class="fw-bold mb-4">人気のトピック</h2>
        <div class="d-flex flex-wrap gap-3">
            
        </div>
    </section>

    <!-- CTA Section -->
    <section class="text-center py-5 bg-light">
        <h2 class="fw-bold">あなたのストーリーを共有しませんか？</h2>
        <p>今すぐアカウントを作成して、あなたのアイデアを世界中に届けましょう。</p>
        <a href="{{ route('register') }}" class="btn btn-success btn-lg">無料で始める</a>
    </section>
</div>
@endsection

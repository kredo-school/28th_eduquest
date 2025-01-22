@extends('layouts.app')

@section('name')
    @section('content')
    <div class="container mt-1">
        <!-- 上部背景 -->
        <div class="p-4" style="background: url('{{ asset('images/Group 209.png') }}') no-repeat center center; background-size:cover;">
            <div class="text-center">
                <h1>Quest Name</h1>
                <p>Quest description<...../p>
            </div>
        </div>
        <!-- 進行状況バー -->
        <div class="d-flex align-items-center mt-3">
            <div class="progress flex-grow-1" style="height: 20px;">
                <div class="pregress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
            </div>
            <button class="btn btn-primary ms-3">Start</button>
        </div>
        <div class="row">
            <!-- 左側（チャプターリスト） -->
            <div class="col-md-6">
                <div class="mt-4" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Chapter1 Name
                            <span class="badge bg-info">💎</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Chapter2 name
                            <span class="badge bg-info">💎</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Chapter3 name
                            <span class="badge bg-info">💎</span>
                        </li>
                    </ul>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-success">Complete</button>
                    <button class="btn btn-success">Boss Fight</button>
                </div>
            </div>
            <!-- 右側（評価とレビュー） -->
            <div class="col-md-6">
                <div class="mt-4">
                    <h5 class="fw-bold">Rating</h5>
                    <p>Average Rating: <span class="fs-3 fw-bold">2.0</span></p>
                    <div>
                        <!-- 1つ星 -->
                        <div class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-3">★</p>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">40%</span>
                        </div>
                        <!-- 2つ星 -->
                        <div class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-3">★★</p>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">30%</span>
                        </div>
                        <!-- 3つ星 -->
                        <div class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-3">★★★</p>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">20%</span>
                        </div>
                        <!-- 4つ星 -->
                        <div class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-3">★★★★</p>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">10%</span>
                        </div>
                        <!-- 5つ星 -->
                        <div class="d-flex align-items-center mb-2">
                            <p class="mb-0 me-3">★★★★★</p>
                            <div class="progress flex-grow-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">0%</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h5>Review</h5>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><strong>My account:</strong> ★★★☆☆</p>
                            <p>コメントがここに入ります...</p>
                            <a href="#" class="btn btn-link">View more</a>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><strong>ユーザー2:</strong> ★★☆☆☆</p>
                            <p>コメントがここに入ります...</p>
                            <a href="#" class="btn btn-link">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
    @section('style')
        
    @endsection
    @section('content')
    <div class="container mt-1">
        <!-- 上部背景 -->
        <div class="p-4 position-relative" style="background: url('{{ asset('images/Group 209.png') }}') no-repeat center center; background-size:cover; height: 168px;">
            <!-- アイコンと名前 詳細-->
            <div class="position-absolute top-0 start-0 p-3">
                <img src="{{ asset('images/icon.png') }}" alt="Icon" class="me-2" style="width: 40px; height: 40px;">
                <span class="fw-bold">Creator's Name</span>
                <p>Quest description goes here...</p>
            </div>
            <!-- クエスト名 -->
            <div class="text-center">
                <h1>Quest Name</h1>
            </div>
            <!-- リワードバッジと目安時間 -->
            <div class="position-absolute top-0 end-0 p-3 text-end">
                <img src="{{ asset('images/reward-badge.png') }}" alt="Reward Badge" class="mb-2" style="width: 50px; height: 50px;">
                <p>Estimated Time: 2 hours</p>
            </div>
    </div>
        </div>
        <!-- 進行状況バー -->
        <div class="d-flex align-items-center mt-3">
            <div class="progress flex-grow-1" style="height: 20px;">
                <div class="pregress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <!-- パーセンテージ表示 -->
            <span class="ms-2 fw-bold">70%</span>
            <!-- スタートボタン -->
            <button class="btn btn-primary ms-3">Start</button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- 左側（チャプターリスト） -->
                <div class="mt-4" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center mb-3">
                            <div class="me-3 bg-light text-center rounded-circle" style="width: 40px; height: 40px; line-height: 40px;">I</div>
                            <div>
                                <h6 class="mb-1">Chapter1 Name</h6>
                                <small>Details of Chapter 1...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center mb-3">
                            <div class="me-3 bg-light text-center rounded-circle" style="width: 40px; height: 40px; line-height: 40px;">II</div>
                            <div>
                                <h6 class="mb-1">Chapter2 Name</h6>
                                <small>Details of Chapter 2...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center mb-3">
                            <div class="me-3 bg-light text-center rounded-circle" style="width: 40px; height: 40px; line-height: 40px;">III</div>
                            <div>
                                <h6 class="mb-1">Chapter3 Name</h6>
                                <small>Details of Chapter 3...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center mb-3">
                            <div class="me-3 bg-light text-center rounded-circle" style="width: 40px; height: 40px; line-height: 40px;">IV</div>
                            <div>
                                <h6 class="mb-1">Chapter4 Name</h6>
                                <small>Details of Chapter 4...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center mb-3">
                            <div class="me-3 bg-light text-center rounded-circle" style="width: 40px; height: 40px; line-height: 40px;">V</div>
                            <div>
                                <h6 class="mb-1">Chapter5 Name</h6>
                                <small>Details of Chapter 5...</small>
                            </div>
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
                <!-- Rating -->
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-bold">Rating</h5>
                            <div class="d-flex align-items-center mb-3">
                                <span class="me-2">Average Rating:</span>
                                <span class="fs-3 fw-bold me-2">2.0</span>
                                <span>★★☆☆☆</span>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                </div>
                 <!-- レビュー -->
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
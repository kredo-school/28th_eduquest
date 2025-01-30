@extends('layouts.app')
    @section('style')
        
    @endsection
    @section('content')
    <div class="container mt-1">
        <!-- 上部背景 -->
        <div class="p-4 position-relative" style="background: url('{{ asset('images/Group 209.png') }}') no-repeat center center; background-size:cover; height: 168px;">
            <!-- アイコンと名前 詳細-->
            <div class="d-flex flex-column align-items-start position-absolute" style="top: 10%; left: 5%;">
                <div class="d-flex align-items-center">
                    <a href="#" class="nav-link d-flex align-items-center  p-3" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle icon">
                            {{-- avatar/icon --}}
                            @if( Auth::user()->image )
                                <img src="{{ Auth::user()->image }}" alt="" class="rounded-circle img-icon">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                    </a>
                    <span class="">{{ $quest_creator->creator_name }}</span>
                </div>
                <div class="w-70 text-wrap text-center">
                    <p class="text-break mb-0">{{ $quest->description }}</p>
                </div>

            </div>
            <!-- クエスト名 -->
            <div class="d-flex justify-content-center align-items-center text-center" style="height: 100%;;">
                <h1>{{ $quest->quest_title }}</h1>
            </div>
            <!-- リワードバッジと目安時間 -->
            <div class="position-absolute flex-column align-items-end p-3" style="top: 5%; right: 5%;">
                <div class="mb-2 pb-0 text-center">
                    <h5 class="mb-1">Reward Badge</h5>
                    <img src="{{{asset('images/jewelry_pyramid_purple.png') }}}" alt="Reward Badge" class="mb-2" style="width: 40px; height: 40px;">
                </div>
                <div class="d-flex align-items-center">
                    <img src="{{{asset('images/udedokei_gold 1.png') }}}" alt="Watch" class="" style="width: 15px; height: 30px;">
                    <div class="ms-2 text-center">
                        <p class="mb-0">Time</p>
                        <p class="mb-0">{{ $quest->total_hours }}h</p>
                    </div>
                </div>
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
            <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white ms-2" style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">Start</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 mt-4>Chapter List</h4>
                <!-- 左側（チャプターリスト） -->
                <div class="mt-3" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group"> 
                        @foreach ($quests_chapters as $quests_chapter) 
                            <li class=""> 
                                <a href="#" class="text-decoration-none border d-flex align-items-center mb-3 p-4"  style="color :#261C11; border-color: #261C11 !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"> 
                                    <div class="d-flex">
                                        <div class="me-3 rounded border d-flex align-items-center justify-content-center bg-white" style="width: 30px; height: 25px; border-color: #261C11 !important; border-radius: 13px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                                            <h6 class="mb-0"><span class="roman-number"></span> </h6>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">{{ $quests_chapter->quest_chapter_title }} </h6>
                                            
                                            <small>{{ $quests_chapter->description }}</small>
                                        </div>
                                    </div> 
                                </a> 
                            </li> 
                        @endforeach 
                    </ul>


                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <div>
                        <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white" style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"><img src="{{{asset('images/image 83.png') }}}" alt="treasure box" class="me-2" style="width: 23px; height: 23px;">Complete</a>
                        <img src="{{{asset('images/tatefuda_yajirushi_01_beige 2左向き.png') }}}" alt="tatefuda" class="" style="width: 28px; height: 28px;">
                    </div>
                    <div>
                        <img src="{{{asset('images/tatefuda_yajirushi_01_beige 2.png') }}}" alt="tatefuda" class="" style="width: 28px; height: 28px;">
                        <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white" style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">Boss Fight<img src="{{{asset('images/sword_longsword_red 1.png') }}}" alt="longsword" class="ms-2" style="width: 23px; height: 23px;"></a>
                    </div>
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
                            {{-- 自分のレビュー --}}
                            @if($user_review)
                                <div class="my-review">
                                    <p><strong>My account:</strong>{{ $user_review->rating }}</p>
                                    <p>{{  $user_review->review  }}</p>
                                    <form method="POST" action="{{ route('reviews.destroy', $user_review->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                    <a href="#" class="btn btn-link">View more</a>
                                </div>
                                @else
                                    <p>レビューをまだ投稿していません。</p>
                                @endif
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            {{-- 他のユーザーのレビュー --}}
                            @forelse($other_reviews as $review)
                                <div class="review">
                                    <p><strong>{{ $review->user->name }}</strong></p>
                                    <p>評価: {{ $review->rating }}/5</p>
                                    <p>{{ $review->review }}</p>
                                </div>
                            @empty
                                <p>まだレビューがありません。</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/chapterlist.js') }}"></script>
@endsection
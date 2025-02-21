@extends('layouts.app')
@section('title', 'Player Chapterlist')
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
                            @if( $quest_creator->creator_image )
                                <img src="{{ $quest_creator->creator_image }}" alt="" class="rounded-circle img-icon">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                    </a>
                    <span class="">{{ $quest_creator->creator_name }}</span>
                </div>
                <div class="w-50 text-wrap text-center">
                    <p class="text-break mb-0" style="word-break: break-word; overflow-wrap: break-word; white-space: normal; display: block; max-width: 100%;">
                        {{ $quest->description }}
                    </p>
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
                    <img src="{{{asset('images/udedokei_gold 1.png') }}}" alt="Watch" class="" style="width: 18px; height: 36px;">
                    <div class="ms-4 text-center">
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
                <div id="progress-bar" class="progress-bar" role="progressbar" 
                    style="width: 0%; background-color: #588157;" 
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <span id="progress-percentage" class="ms-2 fw-bold">0%</span>

            <!-- スタートボタン -->
            <button id="startButton" data-quest-id="{{ $quest->id }}" class="btn border rounded px-3 py-2 bg-white ms-2"
                style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; 
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);" 
                @if($questStatus === 1 || $questStatus === 2)
                    disabled 
                @endif>
                
                @if($questStatus === 1)
                    In Progress
                @elseif($questStatus === 2)
                    Completed
                @else
                    Start
                @endif
            </button>
            <div id="timestampDisplay" class="ms-2">
                @if ($startTimestamp)
                    {{ \Carbon\Carbon::parse($startTimestamp)->format('Y-m-d H:i') }}
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold">Chapter List</h4>
                <!-- 左側（チャプターリスト） -->
                <div class="" style="max-height: 400px; overflow-y: auto;">
                    <ul class="list-group"> 
                        @foreach ($quests_chapters as $quests_chapter) 
                            <li class=""> 
                                <a href="{{ route('chapters.viewing', ['questId' => $quest->id, 'chapterId' => $quests_chapter->id]) }}" class="chapter-link text-decoration-none border  d-flex justify-content-between align-items-center mb-3 p-4" style="color :#261C11; border-color: #261C11 !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"> 
                                    <div class="d-flex">
                                        <!-- 完了したチャプターには画像を表示 -->
                                        <div class="me-3 rounded border d-flex align-items-center justify-content-center bg-white" style="width: 30px !important; height: 25px !important; min-width: 30px; min-height: 25px; border-color: #261C11 !important; border-radius: 13px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                                            <h6 class="mb-0"><span class="roman-number"></span></h6>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold">{{ $quests_chapter->quest_chapter_title }}</h6>
                                            <small>{{ $quests_chapter->description }}</small>
                                        </div>
                                    </div>
                                    <!-- 右側：完了状態の画像 -->
                                    <div class="chapter-status" id="chapter-status-{{ $quests_chapter->id }}">
                                        <!-- JavaScriptで画像を挿入 -->
                                    </div>
                                </a>
                            </li> 
                        @endforeach 
                    </ul>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <div>
                        @if($userQuest)
                            @if($userQuest->status == 2)
                                <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white complete-quest-btn disabled" 
                                data-quest-id="{{ $quest->id }}" data-status="{{ $userQuest->status }}" 
                                style="color :#d3d3d3; border-color: #d3d3d3 !important; border-radius : 20px !important; 
                                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); pointer-events: none;">
                                    <img src="{{ asset('images/jewelry_round_yellow.png') }}" alt="jewelry" class="me-2" style="width: 23px; height: 23px;">Completed
                                </a>  
                            @else
                                <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white complete-quest-btn" 
                                data-quest-id="{{ $quest->id }}" data-status="{{ $userQuest->status }}"
                                style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; 
                                        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                                    <img src="{{ asset('images/image 83.png') }}" alt="treasure box" class="me-2" style="width: 23px; height: 23px;">Complete
                                </a>   
                            @endif
                        @endif


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
                <div class="mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="fw-bold">Rating</h4>
                            <div class="d-flex justify-content-center align-items-center">
                                <h5 class="text-center">Average Rating</h5>
                            </div>
                            <div class="text-center">
                                <h3 class="fw-bold">
                                    @php
                                        // 平均評価の計算
                                        $totalStars = 0;
                                        $totalVotes = 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            $totalStars += $i * ($ratingPercentages[$i] ?? 0);  // 星の数とその割合
                                            $totalVotes += $ratingPercentages[$i] ?? 0;          // 評価したユーザー数
                                        }
                                        $averageRating = $totalVotes > 0 ? $totalStars / $totalVotes : 0;
                                    @endphp
                                    {{ number_format($averageRating, 1) }}
                                    </h3>
                            </div>
                            <div class="text-center">
                                <span>
                                    {{-- 星の表示 --}}
                                    @php
                                        $fullStars = floor($averageRating); // 完全な星の個数
                                        $partialStar = $averageRating - $fullStars; // 部分的な星の割合（小数部分）
                                    @endphp
                                </span>
                        
                                <!-- 星の画像を動的に調整 -->
                                <span>
                                    <span style="position: relative; display: inline-block;">
                                        @for ($i = 1; $i <= $fullStars; $i++)
                                            <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" style="width: 19px; height: 19px; vertical-align: middle;">
                                        @endfor
                                    
                                        {{-- 部分的な星 --}}
                                        @if ($partialStar > 0)
                                            <span class="ms-2" style="position: absolute; overflow: hidden; width: {{ $partialStar * 19 }}px;">
                                                <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" style="width: 19px; height: 19px; vertical-align: middle;">
                                            </span>
                                        @endif
                                    </span>                        
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <!-- 1つ星 -->
                            <div class="mt-2 mb-2">
                                <div class="fw-bold d-flex align-items-center" style="color: #261C11">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <span class="ms-1" style="line-height: 1.2; vertical-align: middle; color: #DA0000;">{{ isset($ratingPercentages[1]) ? $ratingPercentages[1] : 0 }}%</span>
                                </div>
                            </div>
                            <!-- 2つ星 -->
                            <div class="mb-2">
                                <div class="fw-bold d-flex align-items-center" style="color: #261C11">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <span class="ms-1" style="line-height: 1.2; vertical-align: middle; color: #1B30EF;">{{ isset($ratingPercentages[2]) ? $ratingPercentages[2] : 0 }}%</span>
                                </div>
                            </div>
                            <!-- 3つ星 -->
                            <div class="mb-2">
                                <div class="fw-bold d-flex align-items-center" style="color: #261C11">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <span class="ms-1" style="line-height: 1.2; vertical-align: middle; color: #32CC87;">{{ isset($ratingPercentages[3]) ? $ratingPercentages[3] : 0 }}%</span>
                                </div>
                            </div>
                            <!-- 4つ星 -->
                            <div class="mb-2">
                                <div class="fw-bold d-flex align-items-center" style="color: #261C11">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <span class="ms-1" style="line-height: 1.2; vertical-align: middle; color: #1F75E4;">{{ isset($ratingPercentages[4]) ? $ratingPercentages[4] : 0 }}%</span>
                                </div>
                            </div>
                            <!-- 5つ星 -->
                            <div class="mb-1">
                                <div class="fw-bold d-flex align-items-center" style="color: #261C11">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" class="me-1" style="width: 17px; height: 17px;">
                                    <span class="ms-1" style="line-height: 1.2; vertical-align: middle; color: #E48C1F;">{{ isset($ratingPercentages[5]) ? $ratingPercentages[5] : 0 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- レビュー --}}
                <div class="mt-4">
                    <h4 class="fw-bold">Review</h4>
                    <div class="p-1" style="max-height: 250px; overflow-y: auto;">
                        <ul class="list-group list-unstyled">
                            {{-- 自分のレビュー --}}
                            @if($user_review)
                            <li>
                                <div class="d-flex align-items-center mb-2" style="width: 100%;">
                                    <!-- レビュー内容 -->
                                    <div class="review text-decoration-none border d-flex align-items-center p-2 mb-2"
                                        style="color: #261C11; border-color: #261C11 !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); overflow: hidden; width: 77%;">
                                        <!-- アイコン -->
                                        <div class="me-3">
                                            @if(Auth::user()->image)
                                            <img src="{{ asset(Auth::user()->image) }}" alt="" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                            @else
                                            <i class="fas fa-user rounded-circle" style="font-size: 20px; color: #261C11;"></i>
                                            @endif
                                        </div>
                                        <!-- ユーザー名 & レビュー -->
                                        <div class="flex-grow-1 d-flex flex-column">
                                            <strong>{{ Auth::user()->player_nickname }} <span style="font-size: 10px;">(your account)</span></strong>
                                            <p id="comment-review-{{ $user_review->id }}" class="mb-0 review-text p-2" style="max-width: 200px; word-wrap: break-word; overflow-wrap: break-word;">
                                                {{ $user_review->review }}
                                            </p>
                                        </div>
                                        <!-- 星評価 & 「view more >」 -->
                                        <div class="text-end d-flex flex-column align-items-end ms-3">
                                            <div class="fw-bold" style="color: #261C11">
                                                <img src="{{{asset('images/star_yellow 3.png') }}}" alt="star" class="" style="width: 17px; height: 17px; vertical-align: middle;">
                                                {{ $user_review->rating }}
                                            </div>
                                            <span id="{{ $user_review->id }}" class="btn btn-link p-0 ms-2 view-more-btn" style="font-size: 12px; white-space: nowrap;">View more</span>
                                        </div>
                                    </div>
                                    @isset($user_review)
                                        <div class="d-flex align-items-center ms-2">
                                            <button onclick="deleteReview({{ $user_review->id }})"
                                                    class="btn btn-sm border rounded px-3 py-2 bg-white"
                                                    style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                                                <img src="{{ asset('images/image 85.png') }}" alt="treasure box" class="me-1" style="width: 20px; height: 20px;">
                                                Delete
                                            </button>
                                        </div>
                                    @endisset
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!-- 他のユーザーのレビュー -->
                    <div class="p-1" style="max-height: 250px; overflow-y: auto;">
                        <ul class="list-group list-unstyled">
                            @if($other_reviews->isEmpty())
                                <li class="text-center text-muted">No reviews have been posted yet.</li>
                            @else
                                @foreach($other_reviews as $review)
                                    <li>
                                        <div class="review text-decoration-none border d-flex align-items-center p-2 mb-2"
                                            style="color: #261C11; border-color: #261C11 !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); width: 79%; overflow: hidden;">
                                            
                                            <!-- アイコン -->
                                            <div class="me-3">
                                                @if($review->user->image)
                                                    <img src="{{ asset($review->user->image) }}" alt="" class="rounded-circle" width="40" height="40"
                                                        style="object-fit: cover;">
                                                @else
                                                    <i class="fas fa-user rounded-circle" style="font-size: 20px; color: #261C11;"></i>
                                                @endif
                                            </div>
                                
                                            <!-- ユーザー名 & レビュー -->
                                            <div class="flex-grow-1 d-flex flex-column">
                                                <strong>{{ $review->user->player_nickname }}</strong>
                                                <p id="comment-review-{{ $review->id }}" class="mb-0 review-text p-2" style="max-width: 200px; word-wrap: break-word; overflow-wrap: break-word;">
                                                    {{ $review->review }}
                                                </p>
                                            </div>
                                
                                            <!-- 星評価 & 「view more >」 -->
                                            <div class="text-end d-flex flex-column align-items-end ms-3">
                                                <div class="fw-bold" style="color: #261C11">
                                                    <img src="{{ asset('images/star_yellow 3.png') }}" alt="star" style="width: 17px; height: 17px; vertical-align: middle;">
                                                    {{ $review->rating }}
                                                </div>
                                                <span id="{{ $review->id }}" class="btn btn-link p-0 ms-2 view-more-btn" style="font-size: 12px; white-space: nowrap;">View more</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('players.modals.tostart')
@endsection
@section('scripts')
    <script src="{{ asset('js/chapterlist.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // クエストID を Blade から取得
            const questId = "{{ $quest->id }}";
            const userId = "{{ auth()->id() }}";
            // クエストごとに固有の localStorage キーを作成
            const storageKey = "completed_chapters_" + userId + "_" + questId;
            
            // PHP で渡されたチャプター数
            const totalChapters = {{ count($quests_chapters) }};
            // クエストごとの完了チャプターの ID 配列を取得
            const completedChapters = JSON.parse(localStorage.getItem(storageKey) || "[]");
            
            // 進捗率の計算
            let progress = totalChapters > 0 ? Math.round((completedChapters.length / totalChapters) * 100) : 0;
            progress = Math.min(progress, 100);
            
            // 進捗バーの更新
            document.getElementById("progress-bar").style.width = progress + "%";
            document.getElementById("progress-percentage").textContent = progress + "%";
        });
    </script>
    <script>
        document.getElementById('startButton').addEventListener('click', function(e) {
            e.preventDefault(); // デフォルトの動作をキャンセル
            const button = e.currentTarget;
            const questId = button.getAttribute('data-quest-id');
        
            // ボタンが既に無効化されている場合は何もしない
            if (button.disabled || button.textContent.trim() === 'In Progress' || button.textContent.trim() === 'Completed') {
                return;
            }
        
            // ボタンの状態を一旦「In Progress」に変更
            button.disabled = true;
            button.style.backgroundColor = "#f0f0f0";
            button.style.color = "#d3d3d3";
            button.textContent = 'In Progress';
        
            // ステータス更新用のリクエストを送信
            fetch('{{ route('startQuest') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    quest_id: questId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // タイムスタンプの表示
                    const timestampElement = document.getElementById('timestampDisplay');
                    timestampElement.textContent = data.timestamp;
        
                    // ステータスが 2（完了） なら「Completed」に変更
                    if (data.status === 2) {
                        button.textContent = 'Completed';
                        button.style.backgroundColor = "#d3d3d3";
                        button.style.color = "#f0f0f0";
                        button.disabled = true;
                    }
        
                    // 返ってきたステータスに応じた処理
                    if (data.status === 1) {  // 進行中の場合
                        // 既に「In Progress」になっているので、そのままにする
                        button.textContent = 'In Progress';
                        // 必要なら追加のスタイル調整
                    } else if (data.status === 2) {  // 完了の場合
                        button.textContent = 'Completed';
                        button.style.backgroundColor = "#d3d3d3";
                        button.style.color = "#f0f0f0";
                    }
                    // ボタンは無効化のままにする
                    button.disabled = true;
        
                    // 成功時にページをリロードして最新状態を反映する
                    window.location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    

    </script>
    <script>
        // クエストごとに固有のキーを作成
        const questId = "{{ $quest->id }}"; // BladeからクエストIDを取得
        const userId = "{{ auth()->id() }}";
        const storageKey = "completed_chapters_" + userId + "_" + questId;
        // クエストごとの完了チャプターを取得
        const completedChapters = JSON.parse(localStorage.getItem(storageKey) || '[]');
    
        // 各チャプターに対して完了していれば画像を表示
        completedChapters.forEach(function(chapterId) {
            const chapterStatusElement = document.getElementById('chapter-status-' + chapterId);
            if (chapterStatusElement && !chapterStatusElement.querySelector('img')) { // 画像がすでに追加されていない場合
                const img = document.createElement('img');
                img.src = '{{ asset("images/jewelry_pyramid_lightblue 1.png") }}';
                img.alt = '達成';
                img.style.width = '23px';
                img.style.height = '23px';
                chapterStatusElement.appendChild(img);
            }
        });
    </script>
    <script>
        document.querySelectorAll('.complete-quest-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const questId = this.getAttribute('data-quest-id');
                
                fetch("{{ route('quest.complete') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ quest_id: questId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("クエスト完了: ステータスが 2 に更新されました");
                        // 完了後にボタンを無効化するなどの追加処理を実施
                        button.classList.add('disabled');
                        button.disabled = true;
                        button.innerHTML = `
                            <img src="{{ asset('images/jewelry_round_yellow.png') }}" alt="jewelry" class="me-0" style="width: 23px; height: 23px;">
                            Completed
                        `;
                    } else {
                        console.error("クエスト完了エラー");
                    }
                })
                .catch(error => console.error("通信エラー", error));
            });
        });
    </script>
    <script>
        document.querySelectorAll('.view-more-btn').forEach(button => {
            button.addEventListener('click', function() {
                // このボタンが含まれる .review 内の review-text 要素を取得
                const reviewText = this.closest('.review').querySelector('.review-text');
                
                // expanded クラスのトグル
                reviewText.classList.toggle('expanded');
                
                // ボタンのテキストを変更
                if(reviewText.classList.contains('expanded')) {
                    this.textContent = 'View less';
                } else {
                    this.textContent = 'View more';
                }
            });
        });
    </script>
    <script>
        function deleteReview(reviewId) {
            // 確認ダイアログを削除
            fetch(`/reviews/${reviewId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // 削除後、ページをリロードして削除を反映
                if (data.success) {
                    location.reload(); // ページをリロードして削除を反映
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const questStatus = {!! json_encode($questStatus) !!};

        document.querySelectorAll('.chapter-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (questStatus == 0 || questStatus == null) {
                    e.preventDefault();
                    const startModal = document.getElementById('startModal');
                    startModal.classList.add('show');
                    startModal.style.display = 'block';
                    startModal.removeAttribute('aria-hidden');
                    startModal.setAttribute('aria-modal', 'true');

                    // モーダルを閉じる処理
                    startModal.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            startModal.classList.remove('show');
                            startModal.style.display = 'none';
                            startModal.setAttribute('aria-hidden', 'true');
                        });
                    });
                }
            });
        });
    });
</script>

    @endsection


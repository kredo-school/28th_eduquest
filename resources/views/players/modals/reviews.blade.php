<div class="modal fade" id="reviewsModal" tabindex="-1" role="dialog"> 
    <div class="modal-dialog" role="document" style="border: none;"> 
        <div class="modal-content" style="background-color: #588157 !important; color: #FFFFF3; border-radius: 10px; border: none;"> 
            <div class="modal-header" style="background-color: #588157 !important; border: none; padding-bottom: 3px;"> 
                <h3 class="modal-title text-center w-100 mb-0" style="font-size: 24px;">Congratulations!!</h3> 
            </div> 
            <div class="modal-body text-center" style="background-color: #588157 !important;"> 
                <h4 class="mb-0">Review</h4> 
                <div class="review-section" style="background-color: #FFFFF3; color: #261C11; padding: 10px 20px; margin-top: 10px; max-width: 350px; width: 90%; margin: 10px auto;">
                    <form id="review-form" method="POST" action="{{ route('reviews.store', ['questId' => $quest->id]) }}">
                        @csrf
                        <div class="rating d-flex justify-content-center" style="direction: ltr;">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" class="rating-input" style="display:none;">
                                <label for="star{{ $i }}" class="rating-label">
                                    <img src="{{ asset('images/starnotyellow.png') }}" alt="star" style="width: 26px; height: 26px;" class="me-2">
                                </label>
                            @endfor
                        </div>
                    
                        <textarea name="review" class="form-control mt-2" placeholder="Please write your review..."
                            style="border: 2px solid #588157 !important; background-color: #FFFFF3; color: #261C11 !important; padding: 10px; width: 80%; resize: none; display: block; margin: 0 auto;"></textarea>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm border rounded px-3 py-1 bg-white" style="color: #261C11; border-color: #261C11 !important; border-radius: 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">Add</button>
                        </div>
                    </form>                    
                </div>
            </div> 
            <div class=" d-flex justify-content-between mb-3 mx-4">
                <div>
                    <a href="{{ url('/home') }}" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white" style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"><img src="{{{asset('images/shield_kiteshield_02_red 1.png') }}}" alt="treasure box" class="me-2" style="width: 23px; height: 23px;">Go Back</a>
                    <img src="{{{asset('images/tatefuda_yajirushi_01_beige 2左向き.png') }}}" alt="tatefuda" class="" style="width: 28px; height: 28px;">
                </div>
                <div>
                    <img src="{{{asset('images/tatefuda_yajirushi_01_beige 2.png') }}}" alt="tatefuda" class="" style="width: 28px; height: 28px;">
                    <a href="#" type="button" class="text-decoration-none border rounded px-3 py-2 bg-white" style="color :#261C11; border-color: #261C11 !important; border-radius : 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">Boss Fight<img src="{{{asset('images/sword_longsword_red 1.png') }}}" alt="longsword" class="ms-2" style="width: 23px; height: 23px;"></a>
                </div>
            </div>
        </div> 
    </div> 
</div>

<style>
    .rating {
        font-size: 30px;
    }

    .rating-label {
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .rating-label:hover {
        opacity: 0.8;
    }

    .review-section textarea {
        background-color: white;
        color: black;
    }

    .review-section button {
        margin-top: 10px;
    }
</style>

<script>
    // 評価を保持する変数（初期値は0）
    let currentRating = 0;
    
    // 画像のパス（必要に応じて調整してください）
    const whiteStarSrc = "{{ asset('images/starnotyellow.png') }}";
    const yellowStarSrc = "{{ asset('images/star_yellow 3.png') }}"; // 黄色い星の画像
    
    // ラジオボタン（非表示）とラベル（画像）をすべて取得
    const ratingInputs = document.querySelectorAll('.rating-input');
    const ratingLabels = document.querySelectorAll('.rating-label');
    
    // 評価表示を更新する関数
    function updateStars(rating) {
        ratingLabels.forEach((label, idx) => {
            // 星の番号は index+1 として扱う
            if (idx < rating) {
                label.querySelector('img').src = yellowStarSrc;
                ratingInputs[idx].checked = true;
            } else {
                label.querySelector('img').src = whiteStarSrc;
                ratingInputs[idx].checked = false;
            }
        });
    }
    
    // 各星（ラベル）のクリックイベントを設定
    ratingLabels.forEach((label, index) => {
        label.addEventListener('click', function(e) {
            // デフォルトのラベルクリックによる挙動をキャンセル
            e.preventDefault();
            
            let starNumber = index + 1; // 星番号
            
            // すでに選択されている星をクリックした場合は評価をリセット（0にする）
            if (currentRating === starNumber) {
                currentRating = 0;
            } else {
                currentRating = starNumber;
            }
            updateStars(currentRating);
        });
    });
    document.getElementById('review-form').addEventListener('submit', function(e) {
        if (currentRating === 0) {
            e.preventDefault();
            alert('Please select a rating before submitting.');
        }
    });
</script>

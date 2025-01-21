@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navbar content -->
    </nav>
    <!-- Form Start -->
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            
            <!-- Left Side: 大項目 -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="main_title">大項目タイトル</label>
                    <input type="text" class="form-control" id="main_title" name="main_title" required>
                </div>
                <div class="form-group">
                    <label for="main_description">説明</label>
                    <textarea class="form-control" id="main_description" name="main_description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="categories">カテゴリ (最大3つ選択)</label>
                    <select class="form-control" id="categories" name="categories[]" multiple required>
                       {{-- @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <!-- Right Side: 動画の時間選択 -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="video_duration">動画の時間</label>
                    <select class="form-control" id="video_duration" name="video_duration" required>
                        @for($i = 0.5; $i <= 10; $i += 0.5)
                            <option value="{{ $i }}">{{ $i }} 時間</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="video_image">画像アップロード</label>
                    <input type="file" class="form-control-file" id="video_image" name="video_image" onchange="previewImage(event)">
                    <img id="image_preview" class="mt-2" style="max-width: 100%; display: none;">
                </div>
            </div>
        </div>
        <!-- 小項目セクション -->
        <div id="sub_item_section">
            <div class="sub_item mb-4" data-id="1">
                <div class="row">
                    <!-- Left Side: 小項目タイトルと説明 -->
                    <div class="col-md-6">
                        <h5>小項目 1</h5>
                        <div class="form-group">
                            <label for="sub_item_title_1">小項目タイトル</label>
                            <input type="text" class="form-control" id="sub_item_title_1" name="sub_items[1][title]" required>
                        </div>
                        <div class="form-group">
                            <label for="sub_item_description_1">説明</label>
                            <textarea class="form-control" id="sub_item_description_1" name="sub_items[1][description]" rows="4" required></textarea>
                        </div>
                    </div>
                    <!-- Right Side: 動画URLとサムネイル -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_url_1">動画URL</label>
                            <input type="url" class="form-control" id="video_url_1" name="sub_items[1][video_url]" onchange="loadThumbnail(1)">
                            <img id="thumbnail_1" class="mt-2" style="max-width: 100%; display: none;">
                        </div>
                        <button type="button" class="btn btn-danger mt-2" onclick="removeSubItem(1)">削除</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 小項目追加ボタン -->
        <button type="button" class="btn btn-primary mt-3" id="add_sub_item" onclick="addSubItem()">小項目を追加</button>
        <!-- Form Buttons -->
        <div class="form-group mt-4">
            <a href="#" class="btn btn-secondary">キャンセル</a>
            <button type="submit" class="btn btn-success">保存</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
// 画像プレビュー
function previewImage(event) {
    const imagePreview = document.getElementById('image_preview');
    imagePreview.src = URL.createObjectURL(event.target.files[0]);
    imagePreview.style.display = 'block';
}
// サムネイル表示
function loadThumbnail(subItemId) {
    const url = document.getElementById(`video_url_${subItemId}`).value;
    const thumbnailImage = document.getElementById(`thumbnail_${subItemId}`);
    // YouTubeサムネイルを自動取得（例）
    if (url.includes("youtube.com")) {
        const videoId = url.split("v=")[1].split("&")[0];
        thumbnailImage.src = `https://img.youtube.com/vi/${videoId}/0.jpg`;
        thumbnailImage.style.display = 'block';
    }
}
// 小項目を追加
let subItemCount = 1;
function addSubItem() {
    subItemCount++;
    const newSubItem = document.createElement('div');
    newSubItem.classList.add('sub_item', 'mb-4');
    newSubItem.setAttribute('data-id', subItemCount);
    newSubItem.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h5>小項目 ${subItemCount}</h5>
                <div class="form-group">
                    <label for="sub_item_title_${subItemCount}">小項目タイトル</label>
                    <input type="text" class="form-control" id="sub_item_title_${subItemCount}" name="sub_items[${subItemCount}][title]" required>
                </div>
                <div class="form-group">
                    <label for="sub_item_description_${subItemCount}">説明</label>
                    <textarea class="form-control" id="sub_item_description_${subItemCount}" name="sub_items[${subItemCount}][description]" rows="4" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="video_url_${subItemCount}">動画URL</label>
                    <input type="url" class="form-control" id="video_url_${subItemCount}" name="sub_items[${subItemCount}][video_url]" onchange="loadThumbnail(${subItemCount})">
                    <img id="thumbnail_${subItemCount}" class="mt-2" style="max-width: 100%; display: none;">
                </div>
                <button type="button" class="btn btn-danger mt-2" onclick="removeSubItem(${subItemCount})">削除</button>
            </div>
        </div>
    `;
    document.getElementById('sub_item_section').appendChild(newSubItem);
}
// 小項目を削除
function removeSubItem(subItemId) {
    const subItem = document.querySelector(`[data-id='${subItemId}']`);
    subItem.remove();
}
</script>
@endsection
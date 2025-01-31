@extends('layouts.app')
@section('content')
<style>
    .custom-icon {
    color: #80ae80; /* 薄い黄緑色 */
}
</style>

<div class="container mt-5">
    <div class="create-container">
        <!-- Form Start -->
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PATCH') --}}

            <!-------------------[Create a Quest: クエスト作成]-------------------------->
            <div class="quest-container">
                <div class="title-container">
                    <img src="{{ asset('images/flag_02_green.png') }}">
                    <h2>Edit Quest</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quest_title">Title:</label>
                            <input type="text" class="form-control" id="quest_title" name="quest_title" value="{{ old('quest_title', $quest->quest_title)}}" required>
                            @error('quest_title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_hours">Video Length;</label>
                            <select class="form-control" id="total_hours" name="total_hours" required>
                                @for($i = 0.5; $i <= 10; $i += 0.5)
                                <option value="{{ $i }}" {{ old('total_hours', $quest->total_hours) == $i ? 'selected' : '' }}>{{ $i }} 時間</option>
                                @endfor
                            </select>                            
                            @error('total_hours')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $quest->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group thumbnail-container">
                            <label for="video_image">Thumbnail:</label>
                            
                            <!-- 画像プレビューエリア-->
                            <div id="image_preview_container" class="image-preview-container mt-3">
                                @if ($quest->thumbnail)
                                    <img id="image_preview" src="{{ asset('storage/' . $quest->thumbnail) }}" style="max-width: 100%; display: block;">
                                @else
                                    <i class="fa-solid fa-image fa-8x custom-icon"></i>
                                @endif
                            </div>

                            <!-- アップロードボタン-->
                            <button type="button" class="custom-file-button" onclick="document.getElementById('video_image').click();">
                                Upload<img src="{{ asset('images/te_yubisashi_right 3.png') }}">
                            </button>

                            <!-- ファイル選択の非表示入力-->
                            <input type="file" class="form-control-file" id="video_image" name="thumbnail" onchange="previewImage(event)" style="display: none;">
                            @error('video_image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="categories">Select Category (Max: 3)</label>
                        </div>
                            @foreach($categories as $category)
                                <div class="category-option">
                                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="category{{ $category->id }}" class="category-checkbox" {{ in_array($category->id, old('category', $quest->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label for="category{{ $category->id }}">{{ $category->category_name }}</label>
                                </div>
                            @endforeach

                            <!--エラーメッセージの表示-->
                            @if ($errors->has('category'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->get('category') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                </div>
            </div>

            <!-------------------[Create a Chapter: チャプター作成]-------------------------->
            <!-- 章セクション -->
            <div class="chapter-container">
                <div class="row">
                    <div class="title-container">
                        <img src="{{ asset('images/flag_02_blue.png') }}">
                        <h2>Edit Chapter</h2>
                    </div>
                    <div id="sub_item_section">
                        @foreach ($chapters as $index => $chapter)
                        <div class="sub_item mb-4" data-id="{{ $index + 1 }}">
                            <div class="chapter-bg">
                                <h5><i class="fa-solid fa-play m-1"></i>Chapter {{ $index + 1 }}</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-6 chapter-title">
                                    <div class="form-group">
                                        <label for="sub_item_title_{{ $index + 1 }}">Title:</label>
                                        <input type="text" class="form-control" id="sub_item_title_{{ $index + 1 }}" name="sub_items[{{ $index + 1 }}][quest_chapter_title]" value="{{ old('sub_items.' . ($index + 1) . 'quest_chapter_title', $chapter->quest_chapter_title )}}" required>
                                    </div>
                                    
                                    <div id="sub_item_section">
                                        <div class="sub_item mb-4" data-id="1">
                                            <div class="chapter-bg">
                                                <h5><i class="fa-solid fa-play m-1"></i>Chapter 1</h5>
                                            </div>
                                                    
                                            <div class="row">
                                                <div class="col-md-6 chapter-title">
                                                    <div class="form-group">
                                                        <label for="sub_item_title_1">Title:</label>
                                                        <input type="text" class="form-control" id="sub_item_title_1" name="sub_items[1][quest_chapter_title]" value="" required>
                                                    </div>
                                                <div class="form-group">
                                                    <label for="sub_item_description_1">Description:</label>
                                                    <textarea class="form-control" id="sub_item_description_1" name="sub_items[1][description]" rows="4" required></textarea>
                                                </div>
                                            </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="sub_item_description_{{ $index + 1 }}">Description:</label>
                                                        <textarea class="form-control" id="sub_item_description_{{ $index + 1 }}" name="sub_items[{{ $index + 1 }}][description]" rows="4" required>{{ old('sub_items.' . ($index + 1) . '.description', $chapter->description) }}</textarea>

                                                        <label for="video_{{ $index + 1 }}">YouTube Video URL:</label>
                                                        <input type="url" class="form-control" id="video_{{ $index + 1 }}" name="sub_items[{{ $index + 1 }}][video]" value="{{ old('sub_items.' . ($index + 1) . '.video', $chapter->video) }}" placeholder="Enter YouTube video URL" required onchange="updateVideoPreview({{ $index + 1 }})">

                                                        <div class="video-preview-container">
                                                            <iframe id="video_preview_{{ $index + 1 }}" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                        </div>

                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn-design mt-2" onclick="removeSubItem({{ $index + 1 }})">Delete<img src="{{ asset('images/Red Slime.png')}}" style="width: 1.5rem; height: 1.3rem;"></button>
                                                        </div>
                                                    </div>
                                                </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                    <!-- Add more chaptersボタン -->
                    <button type="button" class="btn-add-chapter mt-3" id="add_sub_item" onclick="addSubItem()">
                        <div class="button-content">
                            <img src="{{ asset('images/tatefuda_yajirushi_01_beige 1.png') }}">
                            Add more chapters
                        </div>
                    </button>

                        <!-- Form Buttons -->
                        <div class="btn-container">
                            <div class="form-group form-btn mt-4">
                                <a href="{{ route('quests.index')}}" class="btn-design">Cancel</a>
                                <button type="submit" class="btn-design">Save<img src="{{ asset('images/te_yubisashi_right 3.png') }}"></button>
                            </div>
                        </div>
            </div>
        </form>
    </div>
    
        <div class="bg-img-container">
            <img src="{{ asset('images/Group 235.png') }}" alt="background-img">
        </div>
    
        @endsection
        @section('scripts')

        <script src="{{ asset('js/questform.js') }}"></script>
        <script src="script.js"></script>
        @endsection

    
</div>



    
    
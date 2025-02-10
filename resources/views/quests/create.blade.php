@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="create-container">
        
            <!-- Form Start -->
            <form action="{{ route('quests.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-------------------[Create a Quest: クエスト作成]-------------------------->
                <div class="quest-container">
                    <div class="title-container">
                        <img src="{{ asset('images/flag_02_green.png') }}">
                        <h2>Create Quest</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quest_title">Title:</label>
                                <input type="text" class="form-control" id="quest_title" name="quest_title" value="{{ old('quest_title') }}" required>
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
                                        <option value="{{ $i }}" {{ old('total_hours') == $i ? 'selected' : '' }}>{{ $i }} 時間</option>
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
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_image">Thumbnail URL:</label>
                                <div class="thumbnail-container">
                                    <!-- URL入力欄 -->
                                    <input type="url" class="form-control" id="video_image" name="thumbnail" value="{{ old('thumbnail') }}" placeholder="Enter YouTube thumbnail URL" onchange="previewImage(event)" required>
                                    @error('thumbnail')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 画像プレビューエリア-->
                                <label for="image_preview">Thumbnail Preview:</label>
                                <div id="image_preview_container" class="image-preview-container mt-3">
                                    <img id="image_preview" class="mt-2" style="max-width: 100%; border: 1px solid #ccc; padding: 10px; border-radius: 8px; display: {{ old('thumbnail') ? 'block' : 'none' }};" 
                                        src="{{ old('thumbnail') }}">
                                </div>
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
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}" id="category{{ $category->id }}" class="category-checkbox" {{ in_array($category->id, old('category', [])) ? 'checked' : '' }}>
                                            @if(in_array($category->id, old('category', []))) @endif
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
                <div class="chapter-container">
                        <div class="row">
                            <div class="title-container">
                                <img src="{{ asset('images/flag_02_blue.png') }}">
                                <h2>Create Chapter</h2>
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
                                                <input type="text" class="form-control" id="sub_item_title_1" name="sub_items[1][quest_chapter_title]" value="{{ old('sub_items.1.quest_chapter_title') }}" required>
                                            </div>
                                        <div class="form-group">
                                            <label for="sub_item_description_1">Description:</label>
                                            <textarea class="form-control" id="sub_item_description_1" name="sub_items[1][description]" rows="4" required>{{ old('sub_items.1.description') }}</textarea>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <!---- 動画インプット欄---------->
                                                <label for="sub_item_video_1">YouTube Video URL:</label>
                                                <input type="url" class="form-control" id="sub_item_video_1" name="sub_items[1][video]" value="{{ old('sub_items.1.video') }}" placeholder="Enter YouTube video URL" required onchange="updateVideoPreview()">

                                                <!----- 動画プレビューコンテナ----->
                                                <div class="video-preview-container">
                                                    <iframe id="video_preview" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                </div>                                            

                                                <!------ 削除ボタン------------->
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn-design mt-2" onclick="removeSubItem(1)">Delete<img src="{{ asset('images/delete-icon.png')}}" style="width: 1.5rem; height: 1.3rem;"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 小項目追加ボタン -->
                            <button type="button" class="btn-add-chapter mt-3" id="add_sub_item" onclick="addSubItem()">
                                <div class="button-content">
                                    <img src="{{ asset('images/tatefuda_yajirushi_01_beige 1.png') }}">
                                    Add more chapters
                                </div>
                            </button>
                            
                            
                            <!-- Form Buttons -->
                            <div class="btn-container">
                                <div class="form-group form-btn mt-4">
                                    <a href="#" class="btn-design">Cancel</a>
                                    <button type="submit" class="btn-design">Save<img src="{{ asset('images/te_yubisashi_right 3.png') }}"></button>
                                </div>
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



    
    
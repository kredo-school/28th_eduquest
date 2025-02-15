
        // -----------------------------------[サムネイル表示]--------------------------------------

        document.addEventListener("DOMContentLoaded", function () {
            toggleThumbnailInput();
        });
        
        function toggleThumbnailInput() {
            let type = document.getElementById('thumbnail_type').value;
            let urlInput = document.getElementById('thumbnail_url');
            let fileInput = document.getElementById('thumbnail_image');
            let previewImage = document.getElementById('thumbnail_preview');
        
            if (type === 'url') {
                urlInput.style.display = 'block';
                fileInput.style.display = 'none';
                if (urlInput.value.trim() !== '') {
                    previewImage.src = urlInput.value;
                }else{
                    previewImage.src = "/images/default-thumbnail.png";
                }
            } else {
                urlInput.style.display = 'none';
                fileInput.style.display = 'block';
                previewImage.src = "/images/default-thumbnail.png";

                fileInput.onchange = function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                };
            }
        }
        
        function previewThumbnail() {
            let type = document.getElementById('thumbnail_type').value;
            let previewImage = document.getElementById('thumbnail_preview');
        
            if (type === 'url') {
                let url = document.getElementById('thumbnail_url').value;
                let youtubeId = extractYoutubeId(url);
                if (youtubeId) {
                    previewImage.src = `https://img.youtube.com/vi/${youtubeId}/0.jpg`;
                } else {
                    previewImage.src = "/images/default-thumbnail.png";
                }
            } else {
                let fileInput = document.getElementById('thumbnail_image');
                if (fileInput.files && fileInput.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                } else {
                    previewImage.src = "/images/default-thumbnail.png";
                }
            }
        }
        
        function extractYoutubeId(url) {
            let match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return match ? match[1] : null;
        }

        window.onload = function() {
            toggleThumbnailInput();
        };
        
                       
    　　// --------------------------------------------------------------------------------------




       // -----------------------------------[動画表示]-------------------------------------------

       function updateVideoPreview(input) {
        const videoPreviewContainer = document.querySelector('.video-preview-container');
        const videoPreview = document.getElementById('video_preview');
        const videoUrl = input.value.trim();
    
        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            const videoId = getYouTubeVideoId(videoUrl);
    
            if (videoId) {
                videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
                videoPreviewContainer.style.display = 'block';  // プレビューを表示
            } else {
                alert('Invalid YouTube URL');
                resetVideoPreview();
            }
        } else {
            resetVideoPreview();
        }
    }
    
    // 動画プレビューをリセットする関数
    function resetVideoPreview() {
        const videoPreviewContainer = document.querySelector('.video-preview-container');
        const videoPreview = document.getElementById('video_preview');
    
        videoPreview.src = "";
        videoPreviewContainer.style.display = 'none';  // プレビューを非表示
    }
    
    // YouTube動画IDを抽出する関数
    function getYouTubeVideoId(url) {
        try {
            if (url.includes('youtube.com')) {
                const urlParams = new URLSearchParams(new URL(url).search);
                return urlParams.get('v');
            } else if (url.includes('youtu.be')) {
                return url.split('/').pop();
            }
        } catch (error) {
            console.error("Invalid URL format:", error);
        }
        return null;
    }
        
       // --------------------------------------------------------------------------------------



       // -----------------------------------[カテゴリー選択表示]--------------------------------------
        document.addEventListener('DOMContentLoaded', function () {
            const categoryOptions = document.querySelectorAll('.category-option');
            let selectedCount = 0;

            categoryOptions.forEach(option => {
                option.addEventListener('click', function () {
                    const checkbox = this.querySelector('.category-checkbox');

                    if (checkbox.checked) {
                        // チェックを外す場合
                        checkbox.checked = false;
                        this.classList.remove('selected');
                        selectedCount--;
                    } else if (selectedCount < 3) {
                        // チェックを入れる場合
                        checkbox.checked = true;
                        this.classList.add('selected');
                        selectedCount++;
                    }

                    // 最大選択数に達した場合
                    if (selectedCount >= 3) {
                        // 最大選択数に達したら、それ以外の選択肢を無効にする
                        categoryOptions.forEach(option => {
                            const checkbox = option.querySelector('.category-checkbox');
                            if (!checkbox.checked) {
                                option.style.pointerEvents = 'none'; // チェックされていないものを無効にする
                            }
                        });
                    } else {
                        // 最大選択数未満の場合、すべてのカテゴリーのクリックを有効にする
                        categoryOptions.forEach(option => {
                            option.style.pointerEvents = 'auto'; // 無効を解除
                        });
                    }
                });
            });
        });
         // --------------------------------------------------------------------------------------



        // --------------------------[add more chapters]-------------------------------------------
        let subItemCount = document.querySelectorAll('.sub_item').length; // 初期の番号管理。ページに既に存在する小項目(sub_item)の数を数え、それに基づいて次に追加する番号を決定する。

        // 小項目を追加
        function addSubItem() {
            // subItemCountを最大番号に基づいて更新
            subItemCount = getMaxChapterNumber() + 1;  // 現在の最大番号を取得し、それに1を加えることで次のチャプター番号を決定

            const newSubItem = document.createElement('div');   // 新しいdiv要素を作成して、小項目(sub_item)のcontainerとする。
            newSubItem.classList.add('sub_item', 'mb-4');       // 新しい小項目に対して、'sub_item'クラスとmb-4(マージン)を追加。
            newSubItem.setAttribute('data-id', subItemCount);   // 'data-id'属性として、現在のsubItemCount(新しいチャプター番号)を設定する。

            // 小項目のHTML内容をinnerHTMLで指定
            newSubItem.innerHTML = `
                    <div class="chapter-bg">
                        <h5><i class="fa-solid fa-play m-1"></i>Chapter ${subItemCount}</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 chapter-title">
                            <div class="form-group">
                                <label for="sub_item_title_${subItemCount}">Title:</label>
                                <input type="text" class="form-control" id="sub_item_title_${subItemCount}" name="sub_items[${subItemCount}][quest_chapter_title]" required>
                            </div>
                            <div class="form-group">
                                <label for="sub_item_description_${subItemCount}">Description:</label>
                                <textarea class="form-control" id="sub_item_description_${subItemCount}" name="sub_items[${subItemCount}][description]" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="sub_item_video_${subItemCount}">Video Link:</label>
                                <input type="url" class="form-control" id="sub_item_video_${subItemCount}" name="sub_items[${subItemCount}][video]" onchange="loadVideo(${subItemCount})">
                                
                                <!-- 動画埋め込みプレイヤー -->
                                <div id="video_preview_container_${subItemCount}" class="video-preview-container mt-3" style="display: block;">
                                    <iframe id="video_preview_${subItemCount}" width="560" height="315" frameborder="0" allowfullscreen></iframe>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn-design mt-2" onclick="removeSubItem(1)">
                                            Delete this chapter<img src="/images/delete-icon.png" style="width: 1.5rem; height: 1.3rem;">
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                `;

            // 新しい小項目をページに追加
            document.getElementById('sub_item_section').appendChild(newSubItem);

            // 番号をリセットして再設定
            resetChapterNumbers();  // 番号が飛ばないように、番号をリセットして再設定
        }

        // 小項目を削除
        function removeSubItem(subItemId) {
            const subItem = document.querySelector(`[data-id='${subItemId}']`);  // 削除する小項目をIDで選択
            if (subItem) subItem.remove();   // 選択した小項目を削除

            // 番号をリセット
            resetChapterNumbers();   // 削除後、番号を詰めるために番号をリセット
        }

        // 番号をリセットする関数
        function resetChapterNumbers() {
            const subItems = document.querySelectorAll('.sub_item'); // すべての小項目を取得
            let newCount = 1; // 新しいカウントを1から開始

            subItems.forEach(subItem => {
                const chapterTitle = subItem.querySelector('.chapter-bg h5'); // チャプター番号を表示している部分を選択
                chapterTitle.innerHTML = `<i class="fa-solid fa-play m-1"></i>Chapter ${newCount}`; // チャプター番号を新しい番号で更新

                // 更新された番号で各フィールドのIDと名前を変更
                const titleField = subItem.querySelector('input[type="text"]');  // Titleのフィールド
                titleField.id = `sub_item_title_${newCount}`;
                titleField.name = `sub_items[${newCount}][quest_chapter_title]`;

                const descriptionField = subItem.querySelector('textarea');    // Descriptionのフィールド
                descriptionField.id = `sub_item_description_${newCount}`;
                descriptionField.name = `sub_items[${newCount}][description]`;

                const videoField = subItem.querySelector('input[type="url"]');  // Video URLのフィールド
                videoField.id = `video_${newCount}`;
                videoField.name = `sub_items[${newCount}][video]`;
                videoField.setAttribute('onchange', `loadThumbnail(${newCount})`);    

                const thumbnail = subItem.querySelector('img');      // サムネイル画像
                thumbnail.id = `thumbnail_${newCount}`;

                const deleteButton = subItem.querySelector('button');     // 削除ボタン
                deleteButton.setAttribute('onclick', `removeSubItem(${newCount})`);

                // データIDを更新
                subItem.setAttribute('data-id', newCount);    // 新しいIDを設定

                newCount++;    // 新しい番号を設定
            });

            // 総数を更新
            subItemCount = newCount; // 最後のカウントに同期して次の追加番号を決定
        }

        // 現在表示されている最大のチャプター番号を取得
        function getMaxChapterNumber() {
            const subItems = document.querySelectorAll('.sub_item');
            let maxCount = 0;   // 最大チャプター番号を保持
            subItems.forEach(subItem => {
                const chapterNumber = parseInt(subItem.querySelector('.chapter-bg h5').innerText.replace('Chapter ', ''));
                maxCount = Math.max(maxCount, chapterNumber);   // 最大の番号を更新
            });
            return maxCount;   // 最大のチャプター番号を返す
        }
        // ------------------------------------------------------------------------

    

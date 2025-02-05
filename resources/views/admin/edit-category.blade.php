@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <!-- Category title -->
                    <div class="text-center mb-4" style="font-family: 'DotGothic16', sans-serif; font-weight: bold; font-size: 24px;">
                        Category
                    </div>

                    <!-- Category List -->
                    <div class="category-list">
                        @foreach($categories as $category)
                            <div class="d-flex justify-content-between align-items-center p-2 mb-2" style="background-color: #FFFACD;">
                                <div style="font-family: 'DotGothic16', sans-serif; font-weight: bold;">
                                    <span class="rounded-circle d-inline-flex justify-content-center align-items-center me-2" 
                                          style="width: 24px; height: 24px; background-color: transparent; font-weight: bold;">
                                        {{ $loop->iteration }}
                                    </span>
                                    {{ $category->category_name }}
                                </div>
                                <div>
                                    <button class="btn me-2" 
                                            onclick="openRenameModal({{ $category->id }}, '{{ $category->category_name }}')"
                                            style="font-family: 'DotGothic16', sans-serif; 
                                                   font-weight: bold;
                                                   border-radius: 20px;
                                                   border: 2px solid #333;
                                                   background-color: white;
                                                   padding: 5px 15px;
                                                   transition: all 0.3s;
                                                   box-shadow: 3px 3px 0 #333;"
                                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='5px 5px 0 #333';"
                                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='3px 3px 0 #333';">
                                        Rename
                                    </button>
                                    <button class="btn" 
                                            onclick="openDeleteModal({{ $category->id }}, '{{ $category->category_name }}')"
                                            style="font-family: 'DotGothic16', sans-serif;
                                                   font-weight: bold;
                                                   border-radius: 20px;
                                                   border: 2px solid #333;
                                                   background-color: white;
                                                   padding: 5px 15px;
                                                   transition: all 0.3s;
                                                   box-shadow: 3px 3px 0 #333;"
                                            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='5px 5px 0 #333';"
                                            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='3px 3px 0 #333';">
                                        Delete it
                                    </button>
                                </div>
                            </div>
                            <!-- 透明な行間 -->
                            @if(!$loop->last)
                                <div style="height: 10px;"></div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Create New Category -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <input type="text" id="newCategoryInput" class="form-control me-2" placeholder="Create new category" 
                               style="background-color: #D3D3D3; font-family: 'DotGothic16', sans-serif;">
                        <button class="btn" onclick="openCreateModal()"
                                style="font-family: 'DotGothic16', sans-serif;
                                       font-weight: bold;
                                       border-radius: 20px;
                                       border: 2px solid #333;
                                       background-color: white;
                                       padding: 5px 15px;
                                       transition: all 0.3s;
                                       box-shadow: 3px 3px 0 #333;"
                                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='5px 5px 0 #333';"
                                onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='3px 3px 0 #333';">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rename Modal -->
<div class="modal fade" id="renameModal" tabindex="-1" aria-labelledby="renameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renameModalLabel" style="font-family: 'DotGothic16', sans-serif;">Rename Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="newCategoryName" class="form-control" style="font-family: 'DotGothic16', sans-serif;">
                <input type="hidden" id="categoryId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" 
                        style="font-family: 'DotGothic16', sans-serif;
                               font-weight: bold;
                               border-radius: 20px;
                               border: 2px solid #333;
                               background-color: white;
                               padding: 5px 15px;
                               box-shadow: 3px 3px 0 #333;">Cancel</button>
                <button type="button" class="btn" onclick="updateCategoryName()" 
                        style="font-family: 'DotGothic16', sans-serif;
                               font-weight: bold;
                               border-radius: 20px;
                               border: 2px solid #333;
                               background-color: white;
                               padding: 5px 15px;
                               box-shadow: 3px 3px 0 #333;">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel" style="font-family: 'DotGothic16', sans-serif;">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-family: 'DotGothic16', sans-serif;">
                Are you sure you want to delete "<span id="categoryNameToDelete"></span>"?
                <input type="hidden" id="deleteCategoryId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal" 
                        style="font-family: 'DotGothic16', sans-serif;
                               font-weight: bold;
                               border-radius: 20px;
                               border: 2px solid #333;
                               background-color: white;
                               padding: 5px 15px;
                               box-shadow: 3px 3px 0 #333;">Cancel</button>
                <button type="button" class="btn" onclick="deleteCategory()" 
                        style="font-family: 'DotGothic16', sans-serif;
                               font-weight: bold;
                               border-radius: 20px;
                               border: 2px solid #ff0000;
                               background-color: white;
                               padding: 5px 15px;
                               box-shadow: 3px 3px 0 #ff0000;">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to create this category?</p>
                <p>Category Name: <span id="confirmCategoryName"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="createCategory()">Create</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* navbarのスタイルを完全に削除 */
/* カテゴリーリスト固有のスタイルのみ保持 */
.category-list .btn {
    font-family: 'DotGothic16', sans-serif;
    font-weight: bold;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// カテゴリーモーダル用の関数
function openRenameModal(id, name) {
    document.getElementById('categoryId').value = id;
    document.getElementById('newCategoryName').value = name;
    var renameModal = new bootstrap.Modal(document.getElementById('renameModal'));
    renameModal.show();
}

function openDeleteModal(id, name) {
    document.getElementById('deleteCategoryId').value = id;
    document.getElementById('categoryNameToDelete').textContent = name;
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

function openCreateModal() {
    var newCategoryName = document.getElementById('newCategoryInput').value;
    document.getElementById('confirmCategoryName').textContent = newCategoryName;
    var createModal = new bootstrap.Modal(document.getElementById('createModal'));
    createModal.show();
}

// CRUD操作の関数
function createCategory() {
    var newCategoryName = document.getElementById('newCategoryInput').value;
    
    fetch('/admin/category', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ category_name: newCategoryName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateCategoryName() {
    var id = document.getElementById('categoryId').value;
    var newName = document.getElementById('newCategoryName').value;
    
    fetch(`/admin/category/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ category_name: newName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function deleteCategory() {
    var id = document.getElementById('deleteCategoryId').value;
    
    fetch(`/admin/category/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>

<!-- ヘッダーモーダル用のスクリプトを追加 -->
<script>
window.addEventListener('load', function() {
    if (document.getElementById('userModal')) {
        new bootstrap.Modal(document.getElementById('userModal'));
    }
});
</script>
@endpush
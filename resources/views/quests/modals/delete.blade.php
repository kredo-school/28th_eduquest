<style>

    .modal-content{
        font-family: 'DotGothic16', sans-serif;
    }

    .modal-header{
        background-color: #261C11;
        color: white;
    }

    .modal-body, .modal-footer{
        background-color: #FFFFF3;
    }

    .btn img {
        margin-right: 0;
        padding-right: 0;
        vertical-align: middle;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0; 
    }

</style>


<div class="modal fade" id="delete-quest{{ $quest->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h4 text-light">Delete Your Quest</h3>
            </div>
            <div class="modal-body">
                <p class="text-danger">Warning!</p>
                <p>Are you sure you want to delete your quest?</p>
                <div>
                    <img src="{{ $quest->thumbnail }}" alt="quest-image" class="img-lg">
                    <p class="mt-1 text-muted">{{ $quest->quest_title }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('quests.destroy', $quest->id )}}" method="post" class="d-flex justify-content-center gap-3">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-secondary">
                        <img src="{{ asset('images/cancel-icon.png') }}" alt="Delete Icon" class="delete-icon">Cancel
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger">
                        <img src="{{ asset('images/delete-icon.png') }}" alt="Delete Icon" class="delete-icon">Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
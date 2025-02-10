
<div class="modal fade" id="delete-quest{{ $quest->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header list-modal-header">
                <h3 class="h4 text-light">Delete Your Quest</h3>
            </div>
            <div class="list-modal-body text-center">
                <p class="text-danger fw-bold fs-4">Warning!</p>
                <p class="fs-5">Are you sure you want to delete your quest?</p>
                <div class="warning-box">
                    <img src="{{ $quest->thumbnail }}" alt="quest-image" class="img-lg">
                    <p class="mt-1 text-muted">{{ $quest->quest_title }}</p>
                </div>
            </div>
            <div class="list-modal-footer">
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



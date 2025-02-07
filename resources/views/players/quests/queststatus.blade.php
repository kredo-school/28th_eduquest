@extends('layouts.app')

@section('title', 'Quest Status Page')

@section('content')
<style>
/* 横スクロール用クラス */
.horizontal-scroll {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 1rem; /* 要素間の隙間を1rem */
}

/* カードの固定幅例 */
.quest-card {
    flex: 0 0 auto; /* flex-basis: auto; shrink:0; */
    width: 200px;   /* 横幅を200pxに固定 */
    background: #f8f9fa;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.quest-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
}
</style>

<div class="container">
  <!-- Show the message once delete completedly -->
  @if (session('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

  <h1 class="mb-4">Quest Status Management</h1>
  
  <!-- Watch Later (status=0) -->
  <h2 class="h4">Watch Later</h2>
  <div class="horizontal-scroll mb-4">
    @forelse($watchLater as $uq)
      <div class="quest-card p-2">
        {{-- Quest Thumbnail --}}
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>
        
        <!-- Removeボタン: delete user_questレコード -->
        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
        </form>
      </div>
    @empty
      <p>No Quests in Watch Later</p>
    @endforelse
  </div>

  <!-- In Progress (status=1) -->
  <h2 class="h4">In Progress</h2>
  <div class="horizontal-scroll mb-4">
    @forelse($inProgress as $uq)
      <div class="quest-card p-2">
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>

        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
        </form>
      </div>
    @empty
      <p>No Quests in Progress</p>
    @endforelse
  </div>

  <!-- Completed (status=2) -->
  <h2 class="h4">Completed</h2>
  <div class="horizontal-scroll mb-4">
    @forelse($completed as $uq)
      <div class="quest-card p-2">
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>

        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm w-100">Remove</button>
        </form>
      </div>
    @empty
      <p>No Quests Completed</p>
    @endforelse
  </div>

</div>
@endsection

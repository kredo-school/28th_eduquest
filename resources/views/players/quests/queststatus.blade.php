@extends('layouts.app')

@section('title', 'Quest Status Page')

@section('content')

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
      <div class="quest-item p-2">
        {{-- Quest Thumbnail --}}
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>
        
        <!-- Remove -->
        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-light text-center btn-sm w-25">Remove</button>
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
      <div class="quest-item p-2">
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>

        <!-- Remove -->
        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-light border-black text-center btn-sm w-25">Remove</button>
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
      <div class="quest-item p-2">
        <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        <div class="mt-2">{{ $uq->quest->quest_title }}</div>

        <!-- Remove -->
        <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-light border-black text-center btn-sm w-25">Remove</button>
        </form>
      </div>
    @empty
      <p>No Quests Completed</p>
    @endforelse
  </div>

</div>
@endsection

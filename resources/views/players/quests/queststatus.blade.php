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

  <h1 class="mb-4"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green">Quest Status List</h1>
  
  <!-- Watch Later (status=0) -->
  <h2 class="h4"><img src="{{ asset('images/eye_brown.png') }}" alt="brown_eye" class="flag_red"> Watch Later</h2>
  <div class="horizontal-scroll quests-row mb-4">
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
  <h2 class="h4"><img src="{{ asset('images/sword_longsword_red 1.png') }}" alt="longsword" class="flag_red"> In Progress</h2>
  <div class="horizontal-scroll quests-row mb-4">
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
  <h2 class="h4"><img src="{{ asset('images/image 83.png') }}" alt="Tresure_Chest" class="flag_red"> Completed</h2>
  <div class="horizontal-scroll quests-row mb-4">
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

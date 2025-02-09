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
    {{-- Quest --}}
    <div class="col">
      <div class="quest-card p-2">

        <!-- Thumbnail -->
        <a href="{{ route('quests.chapters', $uq->quest->id) }}">
          <img src="{{ $uq->quest->thumbnail }}" alt="Thumbnail">
        </a>

        <!-- Title -->
        <a href="{{ route('quests.chapters', $uq->quest->id) }}" class="text-dark text-decoration-none">
          <h5 class="mt-2 mb-1">{{ $uq->quest->quest_title }}</h5>
        </a>

        <!-- Creator Icon + Name -->
        @if($uq->quest->creator)
            <div class="creator-info">
                <a href="{{ route('questcreators.profile.view', $uq->quest->creator->user_id) }}">
                    @if($uq->quest->creator->creator_image)
                        <img src="{{ $uq->quest->creator->creator_image }}" alt="Creator Icon">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </a>
                <a href="{{ route('questcreators.profile.view', $uq->quest->creator->user_id) }}" class="text-dark text-decoration-none">
                    <span>{{ $uq->quest->creator->creator_name }}</span>
                </a>
            </div>
        @else
            <div class="creator-info">
                <i class="fas fa-user"></i>
                <span>Unknown Creator</span>
            </div>
        @endif

      </div><!-- /.quest-card -->

      <!-- Removeボタン -->
      <form action="{{ route('quest.status.remove', $uq->id) }}" method="POST" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-light text-center btn-sm w-25">Remove</button>
      </form>

    </div><!-- /.col -->
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

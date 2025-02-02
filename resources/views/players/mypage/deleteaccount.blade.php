@extends('layouts.app')

@section('title', 'Delete My Account')

@section('content')

<div class="row align-items-start">

    @include('players.mypage.accountmenu.accountmenu')
        
    <div class="col-8 ms-5">
        <div class="text-start mb-5">
            <h1 class="h2 m-0 d-flex">
                <img src="{{ asset('images/flag_red.png') }}" alt="Icon" class="mb-1 flag_red me-3"> 
                Delete Account
            </h1>
        </div>

        <div class="text-start">
            <p class="text-danger fs-3">Warning!!!</p>
            <p class="text-dark fs-5">When you delete your account, all completed quests will be reset. Additionally, even if you create a new account using the same email address in the future, you will no longer be able to access your current account or any data associated with it.</p>
        </div>

        <form action="{{ route('destroy.account') }}" method="post">
        @csrf
        @method('DELETE')
            <button 
                type="submit" 
                class="btn bg-white w-25 text-dark rounded-pill border border-dark fw-bald" onclick="Are you sure you want to delete your account?"
            >
                Delete Account?
            </button>
        </form>
    </div>
</div>
@endsection
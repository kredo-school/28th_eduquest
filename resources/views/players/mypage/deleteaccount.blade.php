@extends('layouts.app')

@section('title', 'Delete My Account')

@section('content')

    @include('players.mypage.accountmenu.accountmenu')
        
    <div class="col-8 ms-5">
        <div class="text-start mb-5 account-title">
            <h1 class="h2 m-0">
                <img src="{{ asset('images/flag_red.png') }}" alt="Icon" class="switch-player-image mb-5"> 
                Delete Account
            </h1>
        </div>
    </div>
@endsection
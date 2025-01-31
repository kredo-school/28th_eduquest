@extends('layouts.app')

@section('title', 'Delete My Account')

@section('content')

<div class="row align-items-start">

    @include('players.mypage.accountmenu.accountmenu')

    {{-- Delete Account --}}
    <div class="col-8 ms-5">
        delete account
    </div>
</div>
    
@endsection
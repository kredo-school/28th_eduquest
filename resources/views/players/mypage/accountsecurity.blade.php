@extends('layouts.app')

@section('title', 'Account Security')

@section('content')

<div class="row align-items-start">

    @include('players.mypage.accountmenu.accountmenu')

    {{-- Forms --}}
    <div class="col-8 ms-5">
        
            {{-- Title --}}
        <div class="text-start mb-5">
            <h1 class="h2 m-0"><img src="{{ asset('images/ie.png') }}" alt="Icon" class="title-icon house"> Account Security</h1>
            <form action="{{ route('update.emailaddress') }}" method="post">
            @csrf
            @method('PATCH')
                <div class="p-3">
                    {{-- Change Email Address Title --}}
                    <h2 class="h4 align-items-center"><img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green"> Change Email Address</h2>

                    {{-- Email Address --}}
                    <div class="row mb-3">
                        <label for="email" class="col-md-2 col-form-label fw-bold mb-0">Email Address :</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control w-75 ms-3" value="{{ old('email', Auth::user()->email) }}">
                            {{-- Error message --}}
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="row mb-3">
                        <label for="password" class="col-md-2 col-form-label fw-bold mb-0">Password :</label>
                        <div class="col-md-6">
                            <input type="password" name="password" id="password" class="w-75 ms-3 form-control @error('password') is-invalid @enderror" required>
                            {{-- Error message --}}
                            @error('password')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
    
@endsection
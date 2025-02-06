@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-image: url('/images/resistration_bg.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="card-header" style="text-align: center; border-bottom: none;">
                    <img src="../images/character_yusha_01_green.png" 
                    alt="yusya_man" style="width: 25px; height: 25px; margin: 5px;">{{ __('Registration') }}<img
                    src="..\images\character_yusha_woman_red.png" alt="yusya_woman"
                    style="width: 25px; height: 25px; margin: 5px;">
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Nickname --}}
                        <div class="form-group row mt-3 mb-3">
                            <label for="player_nickname"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nickname') }}</label>

                            <div class="col-md-6">
                                <input id="player_nickname" type="text"
                                    class="form-control @error('player_nickname') is-invalid @enderror"
                                    name="player_nickname" value="{{ old('player_nickname') }}" required
                                    autocomplete="player_nickname" aria-label="Nickname" aria-required="true" autofocus
                                    placeholder="Enter your nickname">

                                @error('player_nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Please enter your nickname.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    aria-label="Email Address" aria-required="true" placeholder="example@example.com">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Please enter a valid email address.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- First name --}}
                        <div class="form-group row mb-3">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"
                                    class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    value="{{ old('first_name') }}" required autocomplete="first_name"
                                    aria-label="First Name" aria-required="true" placeholder="John">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Please enter your first name.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Family name --}}
                        <div class="form-group row mb-3">
                            <label for="family_name"
                                class="col-md-4 col-form-label text-md-end">{{ __('Family Name') }}</label>

                            <div class="col-md-6">
                                <input id="family_name" type="text"
                                    class="form-control @error('family_name') is-invalid @enderror" name="family_name"
                                    value="{{ old('family_name') }}" required autocomplete="family_name"
                                    aria-label="Family Name" aria-required="true" placeholder="Doe">

                                @error('family_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Please enter your family name.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="form-group row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" aria-label="Password" aria-required="true"
                                    placeholder="Enter a password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Password must be at least 8 characters.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-group row mb-3">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    aria-label="Confirm Password" aria-required="true"
                                    placeholder="Enter your password again">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? 'Password confirmation does not match.' }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                                <button type="submit"
                                    class="btn w-100 me-4 bg-white text-dark fw-bold rounded-pill border border-dark">
                                    <img src="..\images\mark_maru.png" alt="maru"
                                        style="width: 20px; height: 20px; margin: 5px;">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ url('/') }}"
                                    class="btn w-100 bg-white text-dark fw-bold rounded-pill border border-dark">
                                    <img src="..\images\mark_batsu.png" alt="batsu"
                                        style="width: 20px; height: 20px; margin: 5px;">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

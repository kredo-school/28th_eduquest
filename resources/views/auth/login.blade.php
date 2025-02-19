@extends('layouts.app')

@section('title', 'Log in')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card sign-in card">
                {{-- Sign in --}}
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="card-body sign-in-card-body text-center fw-bold bg-white">
                        <img src="..\images\character_yusha_01_green.png"
                            alt="yusya_man" style="min-width: 25px; min-height: 25px; width: 25px; height: 25px; margin: 5px; object-fit: contain;">{{ __('Login') }}<img
                            src="..\images\character_yusha_woman_red.png" alt="yusya_woman"
                            style="min-width: 25px; min-height: 25px; width: 25px; height: 25px; margin: 5px; object-fit: contain;">
                    
                {{-- Email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@example.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"placeholder="Enter a password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                {{-- Remember Me --}}
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input m-0" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label m-0" for="remember">
                                        {{('Remember Me')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                {{-- Sign In Buttons--}}
                        <div class="row mb-0">
                              <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                                <button type="submit"
                                class="btn w-100 me-4 bg-white text-dark fw-bold rounded-pill border border-dark">
                                <img src="..\images\mark_diamond_red.png" alt="diamond"
                                    style="width: 20px; height: 20px; margin: 5px;">
                                {{ __('Login') }}
                                </button>

                                <!-- ②Registrationボタンを追加する -->
                              <a href="{{ route('register') }}"
                                  class="btn w-100 bg-white text-dark fw-bold rounded-pill border border-dark" 
                                  style="text-decoration: none;">
                                   <img src="..\images\mark_diamond_yellow.png" alt="diamond"
                                        style="width: 20px; height: 20px; margin: 5px;">
                                   {{ __('Register') }}
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
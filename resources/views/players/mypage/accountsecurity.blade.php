@extends('layouts.app')

@section('title', 'Account Security')

@section('content')

<div class="row align-items-start">

    @include('players.mypage.accountmenu.accountmenu')
    
    <div class="col-8 ms-5">
        <div class="text-start mb-5">
            <h1 class="h2 m-0">
                <img src="{{ asset('images/ie.png') }}" alt="Icon" class="title-icon house mb-5"> 
                Account Security
            </h1>

            {{-- ================== Change Email Address ================== --}}
            <form action="{{ route('update.emailaddress') }}" method="post">
                @csrf
                @method('PATCH') 
                <div class="p-3">
                    <h2 class="h4 mb-3">
                        <img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green"> 
                        Change Email Address
                    </h2>

                    <div class="row mb-3">
                        <label for="email" class="col-md-2 col-form-label fw-bold mb-0">
                            Email Address:
                        </label>
                        <div class="col-md-6">
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control w-75 ms-3 
                                    @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}"
                                required
                            >
                            @error('email')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-2 col-form-label fw-bold mb-0">
                            Password:
                        </label>
                        <div class="col-md-6">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control w-75 ms-3 
                                    @error('password') is-invalid @enderror"
                                placeholder="Enter your current password"
                                required 
                                autocomplete="current-password"
                            >
                            @error('password')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 ms-3">
                            <button 
                                type="submit" 
                                class="btn bg-white w-25 text-dark rounded-pill border border-dark"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- ================== Change Password ================== --}}
            <form action="{{ route('update.password') }}" method="post">
                @csrf
                @method('PATCH')
                <div class="p-3">
                    <h2 class="h4 mb-3">
                        <img src="{{ asset('images/flag_green.png') }}" alt="flag_green" class="flag_green"> 
                        Change Password
                    </h2>

                    <div class="row mb-4">
                        <label for="currentpass" class="col-md-3 col-form-label fw-bold mb-0">
                            Current Password:
                        </label>
                        <div class="col-md-5">
                            <input 
                                type="password" 
                                name="currentpass" 
                                id="currentpass" 
                                class="form-control w-75 ms-3 
                                    @error('currentpass') is-invalid @enderror" 
                                placeholder="Enter your current password" 
                                required
                            >
                            @error('currentpass')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="newpass" class="col-md-3 col-form-label fw-bold mb-0">
                            New Password:
                        </label>
                        <div class="col-md-5">
                            <input 
                                type="password" 
                                name="newpass" 
                                id="newpass" 
                                class="form-control w-75 ms-3 
                                    @error('newpass') is-invalid @enderror" 
                                placeholder="Enter a new password"
                                required
                            >
                            @error('newpass')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="newpass2" class="col-md-3 col-form-label fw-bold mb-0">
                            Confirm New Password:
                        </label>
                        <div class="col-md-5">
                            <input 
                                type="password" 
                                name="newpass2" 
                                id="newpass2" 
                                class="form-control w-75 ms-3" 
                                placeholder="Enter the new password again"
                                required
                            >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8 ms-3">
                            <button 
                                type="submit" 
                                class="btn bg-white w-25 text-dark rounded-pill border border-dark"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

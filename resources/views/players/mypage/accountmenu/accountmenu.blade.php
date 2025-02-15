{{-- 1　Icon + Account Menu --}}
<div class="switch-side-bar col-3 bg-white text-center pb-3">
    {{-- 2 --}}
    <div>
        @if (Auth::user()->image)
            <img src="{{Auth::user()->image}}" alt="User Icon" class="switch-player-image border border-dark rounded-circle">
            
        @else
            <img src="{{ asset('images/User icon.png')}}" alt="playerimage" class="switch-player-image">    
        @endif
        
    </div>
    <div class="mb-3">
        <input type="file" name="creator_image" id="image" class="form-control form-control-sm mt-1" aria-describedby="avatar-info">
                @error('avatar')
                    <p class="text-danger small">{{ $message }}</p>
                @enderror
        {{-- 3 --}}
        <div class="accetable" style="text-align: center">
            <p>Accetable formats:jpeg,jpg,png,gif only.</p>
            <p>Max file size: 1048kB</p>
        </div>

        <!-- Uploadボタン -->
        <div class="text-center mt-2">
            <button type="submit" class="btn btn-sm border rounded px-3 py-2" style="color: #261C11; background-color:#fffff3; border-color: #261C11 !important; border-radius: 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">Upload</button>
        </div>
    </div>
    {{-- 4 --}}
    <div style="text-align: left">
        <a href="{{ route('account.security', Auth::user()->id) }}" class="text-decoration-none fs-6 text-dark"><img src={{ asset('images/sword.png') }} alt="sword" class="homeSword"> Account Securlty</a>
    </div>
        @auth
            @if ( auth()->user()->role_id === 1)
                <div style="text-align: left">
                    <a href="{{ route('player.switch', Auth::user()->id) }}" class="text-decoration-none fs-6 text-dark"><img src={{ asset('images/sword.png') }} alt="sword" class="homeSword"> Switch to Quest Creator Account</a>
                </div>
            @endif
        @endauth
    <div style="text-align: left">
        <a href="{{ route('delete.account', Auth::user()->id) }}" class="text-decoration-none fs-6 text-dark"><img src={{ asset('images/sword.png') }} alt="sword" class="homeSword"> Delete My Account</a>
    </div>
</div>
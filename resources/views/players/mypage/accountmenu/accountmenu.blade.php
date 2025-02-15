<div class="side-bar col-3 bg-white text-center pb-3">
    {{-- 1. Icon表示部分 --}}
    <div>
        @if(auth()->user()->image)
            {{-- 既にユーザーのimageカラムにパスが入っている場合 --}}
            <img src="{{ asset(auth()->user()->image) }}" alt="playerimage" class="player-image">
        @else
            {{-- imageカラムが空の場合 --}}
            <img src="{{ asset('images/User icon.png') }}" alt="playerimage" class="player-image">
        @endif
    </div>

    {{-- 2. アイコンアップロードフォーム --}}
    <form action="{{ route('upload.creator.image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            {{-- ファイル入力欄 --}}
            <input 
                type="file" 
                name="player_image" 
                id="image" 
                class="form-control form-control-sm mt-1" 
                aria-describedby="avatar-info"
            >

            {{-- バリデーションエラー表示（name属性と合わせる） --}}
            @error('player_image')
                <p class="text-danger small">{{ $message }}</p>
            @enderror

            <div class="Accetable text-center">
                <p>Accetable formats: jpeg, jpg, png, gif only.</p>
                <p>Max file size: 1048kB</p>
            </div>

            {{-- Uploadボタン --}}
            <div class="text-center mt-2">
                <button 
                    type="submit" 
                    class="btn btn-sm border rounded px-3 py-2" 
                    style="color: #261C11; background-color: #fffff3; border-color: #261C11 !important; border-radius: 20px !important; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);"
                >
                    Upload
                </button>
            </div>
        </div>
    </form>

    {{-- 3. Account Menuの各リンク --}}
    <div style="text-align: left">
        <img src="{{ asset('images/sword.png') }}" alt="sword" class="homeSword">
        <a href="#" class="text-decoration-none fs-6 text-dark">Account Security</a>
    </div>

    @auth
        @if (auth()->user()->role_id === 1)
            <div style="text-align: left">
                <img src="{{ asset('images/sword.png') }}" alt="sword" class="homeSword">
                <a 
                    href="{{ route('player.switch', Auth::user()->id) }}" 
                    class="text-decoration-none fs-6 text-dark"
                >
                    Switch to Quest Creator Account
                </a>
            </div>
        @endif
    @endauth

    <div style="text-align: left">
        <img src="{{ asset('images/sword.png') }}" alt="sword" class="homeSword">
        <a 
            href="{{ route('delete.account', Au

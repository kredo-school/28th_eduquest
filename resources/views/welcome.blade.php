@extends('layouts.app')

@php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
@endphp

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-center mb-4">
        <img src="{{ url('..\images\character_yusha_01_green.png') }}" alt="yusya_man" class="me-2" style="width: 24px; height: 24px;">
        <h1 class="mb-0" style="font-family: 'DotGothic16', sans-serif;">
            @if(isset($currentCategory))
                {{ $currentCategory->category_name }} Quest List
            @else
                Quest List
            @endif
        </h1>
        <img src="{{ url('..\images\character_yusha_woman_red.png') }}" alt="yusya_woman" class="ms-2" style="width: 24px; height: 24px;">
    </div>
    
    <!-- Featured Content Section -->
    <div class="container px-4" style="background-color: #FCFCE7;border-radius: 15px;">
    <section class="my-5">
        <div class="container px-4" style="width: 1200px; max-width: 100%;">
            <div class="row g-4">
                @foreach($quests as $quest)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card h-100 shadow-sm" style="border: 1px solid #000000; background-color: #ffffff;">
                            <!-- Thumbnail with spacing -->
                            <div class="px-2 pt-2">
                                <div class="quest-thumbnail-container position-relative bg-white" style="padding-top: 56.25%;">
                                    @if($quest->thumbnail)
                                        <img src="{{ $quest->thumbnail }}" 
                                             class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
                                             alt="{{ $quest->quest_title }}"
                                             style="object-position: center;">
                                    @else
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                            <span class="text-muted" style="font-family: 'DotGothic16', sans-serif;">Thumbnail</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Category Badge -->
                            <div class="px-2 py-2">
                                @if($quest->categories->first())
                                    <a href="{{ route('quests.category', $quest->categories->first()) }}" 
                                       class="text-decoration-none">
                                        <span class="badge" style="background-color: #4a7555; font-size: 0.8rem; font-family: 'DotGothic16', sans-serif;">
                                            {{ $quest->categories->first()->category_name }}
                                        </span>
                                    </a>
                                @else
                                    <span class="badge" style="background-color: #4a7555; font-size: 0.8rem; font-family: 'DotGothic16', sans-serif;">
                                        Categories
                                    </span>
                                @endif
                            </div>

                            <!-- Quest Info -->
                            <div class="card-body px-2">
                                <h5 class="card-title mb-2" style="font-family: 'DotGothic16', sans-serif; font-size: 0.9rem;">{{ $quest->quest_title }}</h5>
                                
                                <!-- Creator Info -->
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle overflow-hidden" style="width: 30px; height: 30px;">
                                        @if($quest->questCreator && $quest->questCreator->creator_image)
                                            <img src="{{ $quest->questCreator->creator_image }}" alt="Creator Avatar" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <img src="{{ url('images/character_yusha_01_green.png') }}" alt="Default Creator Avatar" class="w-100 h-100 object-fit-cover">
                                        @endif
                                    </div>
                                    <span style="font-family: 'DotGothic16', sans-serif; font-size: 0.8rem;">
                                        {{ $quest->questCreator->creator_name ?? 'Unknown' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                @if ($quests->hasPages())
                    <nav aria-label="Page navigation" style="background: none;">
                        <ul class="pagination" style="background: none;">
                            {{-- Previous Page Link --}}
                            @if ($quests->onFirstPage())
                                <li class="page-item disabled" style="background: none;">
                                    <span class="page-link" style="color: #4a7555; background: none; border: none;">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item" style="background: none;">
                                    <a class="page-link" href="{{ $quests->previousPageUrl() }}" style="color: #4a7555; background: none; border: none;">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($quests->getUrlRange(1, $quests->lastPage()) as $page => $url)
                                @if ($page == $quests->currentPage())
                                    <li class="page-item active" style="background: none;">
                                        <span class="page-link" style="color: #4a7555; font-weight: bold; background: none; border: none;">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item" style="background: none;">
                                        <a class="page-link" href="{{ $url }}" style="color: #4a7555; background: none; border: none;">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($quests->hasMorePages())
                                <li class="page-item" style="background: none;">
                                    <a class="page-link" href="{{ $quests->nextPageUrl() }}" style="color: #4a7555; background: none; border: none;">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled" style="background: none;">
                                    <span class="page-link" style="color: #4a7555; background: none; border: none;">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </section>
    </div>
</div>

    <script>
    function toggleDescription(button) {
        const container = button.closest('.description-container');
        const shortText = container.querySelector('.description-text');
        const fullText = container.querySelector('.description-full');
        
        if (shortText.style.display !== 'none') {
            shortText.style.display = 'none';
            fullText.style.display = 'block';
            button.textContent = 'Show Less';
        } else {
            shortText.style.display = '-webkit-box';
            fullText.style.display = 'none';
            button.textContent = 'Read More';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.description-container').forEach(container => {
            const shortText = container.querySelector('.description-text');
            const button = container.querySelector('button');
            
            // 5行以下の場合はボタンを非表示
            if (shortText.scrollHeight <= shortText.clientHeight) {
                button.style.display = 'none';
            }
        });
    });
    </script>
</div>
@endsection

<style>
body {
    background-color: #ffffff;
}

.pagination {
    gap: 5px;
    background: none !important;
}

.page-link {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'DotGothic16', sans-serif;
    transition: all 0.3s ease;
    background: none !important;
    border: none !important;
}

.page-link:hover {
    color: #2d4734 !important;
    background: none !important;
}

.page-item {
    background: none !important;
}

.page-item.active .page-link {
    background: none !important;
}

.page-item.disabled .page-link {
    opacity: 0.5;
    background: none !important;
}

nav[aria-label="Page navigation"] {
    background: none !important;
}
</style>
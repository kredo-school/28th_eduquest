@extends('layouts.app')

@php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
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
                                <div class="position-relative">
                                    @if($quest->categories)
                                        @foreach($quest->categories as $category)
                                            <span class="badge" style="background-color: #4B7355;">{{ $category->category_name }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Quest Info -->
                            <div class="card-body px-2">
                                <h5 class="card-title mb-2" style="font-family: 'DotGothic16', sans-serif; font-size: 0.9rem;">{{ $quest->quest_title }}</h5>
                                
                                <!-- Creator Info -->
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle overflow-hidden" style="width: 30px; height: 30px;">
                                        <img src="{{ $quest->questCreator->creator_image }}" alt="creator icon" class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <span style="font-family: 'DotGothic16', sans-serif; font-size: 0.8rem;">{{ $quest->questCreator->creator_name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if(method_exists($quests, 'links'))
                <div class="d-flex justify-content-center mt-5">
                    {{ $quests->links() }}
                </div>
            @endif
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
<!-- Display latest news title and date on the button -->
<div class="row gx-5">
    <div class="col-5 text-start">
        @if (!empty($news_lists)) 
            <button type="button" class="btn btn-light btn-custom-border w-100 text-start" data-bs-toggle="modal" data-bs-target="#newsModal">
                NEWS   - {{ date('M d, Y', strtotime($news_lists[0]->created_at)) }} | {{ $news_lists[0]->title }}
            </button>
        @else
            <button type="button" class="btn btn-light btn-custom-border w-100 text-start" disabled>
                No News Available
            </button>
        @endif
        
        <!-- Modal window -->
        <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newsModalLabel">News List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- News list --}}
                        @if (empty($news_lists)) 
                            <p class="text-center">No news available.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($news_lists as $news)
                                    <li class="list-group-item">
                                        <strong>{{ date('M d, Y', strtotime($news->created_at)) }}</strong>: 
                                        {{ $news->title }}
                                        <p>{{ $news->content }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
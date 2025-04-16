@if ($collection->lastPage() > 1)
    <div class="pagination d-flex flex-wrap gap-1 mt-3">
        {{-- Previous --}}
        @if ($collection->onFirstPage())
            <span class="page-link disabled">‹</span>
        @else
            <a href="{{ $collection->previousPageUrl() }}" class="page-link">‹</a>
        @endif

        {{-- Page numbers --}}
        @foreach ($collection->getUrlRange(1, $collection->lastPage()) as $page => $url)
            @if ($page == $collection->currentPage())
                <span class="page-link active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($collection->hasMorePages())
            <a href="{{ $collection->nextPageUrl() }}" class="page-link">›</a>
        @else
            <span class="page-link disabled">›</span>
        @endif
    </div>
@endif

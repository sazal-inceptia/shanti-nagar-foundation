@if ($paginator->hasPages())
    <ul class="pagination clearfix">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="javascript:void(0);" style="opacity: 0.5; pointer-events: none;"><i class="far fa-angle-double-left"></i></a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="far fa-angle-double-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><a href="javascript:void(0);" style="opacity: 0.5; pointer-events: none;">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="javascript:void(0);" class="current">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="far fa-angle-double-right"></i></a></li>
        @else
            <li class="disabled"><a href="javascript:void(0);" style="opacity: 0.5; pointer-events: none;"><i class="far fa-angle-double-right"></i></a></li>
        @endif
    </ul>
@endif

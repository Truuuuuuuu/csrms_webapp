@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $max = 5;

                // Calculate start and end page
                $start = max(1, $current - 2);
                $end = min($last, $start + $max - 1);

                if ($end - $start < $max - 1) {
                    $start = max(1, $end - $max + 1);
                }
            @endphp

            {{-- First page + dots --}}
            @if ($start > 1)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                @if ($start > 2)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif
            @endif

            {{-- Page Numbers --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $current)
                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Last page + dots --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <li class="page-item disabled"><span class="page-link">…</span></li>
                @endif
                <li class="page-item"><a class="page-link" href="{{ $paginator->url($last) }}">{{ $last }}</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif

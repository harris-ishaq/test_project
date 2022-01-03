@if ($paginator->hasPages())
<nav class="d-inline-block">
    <ul class="pagination mx-auto">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
            </li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}<span class="sr-only">{{ $page }}</span></a></li>
                        <!-- <li class="active my-active"><span>{{ $page }}</span></li> -->
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        <!-- <li><a href="{{ $url }}">{{ $page }}</a></li> -->
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
            </li>
            <!-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li> -->
        @else
            <li class="page-item disabled">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fas fa-chevron-right"></i></a>
            </li>
            <!-- <li class="disabled"><span>Next →</span></li> -->
        @endif
    </ul>
</nav>
@endif

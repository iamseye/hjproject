@if ($paginator->lastPage() > 1)
    <ul id="goPage">
        <a href="{{ $paginator->url(1) }}">
            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                上一頁
            </li>
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <a href="{{ $paginator->url($i) }}">
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    {{ $i }}
                </li>
            </a>
        @endfor
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                下一頁
            </li>
        </a>
    </ul>
@endif


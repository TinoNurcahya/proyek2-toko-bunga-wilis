@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination pagination-sm mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">‹</span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="page-link"
                        rel="prev">‹</button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <button type="button" wire:click="gotoPage({{ $page }})"
                                    class="page-link">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="page-link"
                        rel="next">›</button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">›</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@if($paginator->hasPages())
    <nav class="pagination-wrap" aria-label="Navigasi halaman">

        @if($paginator->onFirstPage())
            <span class="pagination-disabled">← Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Sebelumnya</a>
        @endif

        <span>Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya →</a>
        @else
            <span class="pagination-disabled">Selanjutnya →</span>
        @endif

    </nav>
@endif
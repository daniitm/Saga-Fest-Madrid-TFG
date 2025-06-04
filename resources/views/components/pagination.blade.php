@if ($paginator->hasPages())
    <nav aria-label="Paginación" class="mt-8">
        {{-- Vista móvil: sólo botones Anterior/Siguiente y página actual --}}
        <div class="flex flex-col gap-2 sm:hidden">
            <div class="text-center text-sm text-white/80">
                Página
                <span class="font-semibold text-white">{{ $paginator->currentPage() }}</span>
                de
                <span class="font-semibold text-white">{{ $paginator->lastPage() }}</span>
            </div>
            <div class="flex justify-between gap-2">
                {{-- Botón Anterior --}}
                @if ($paginator->onFirstPage())
                    <span class="flex-1 px-5 py-2 rounded bg-primary text-white cursor-not-allowed text-center select-none">Anterior</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex-1 px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white text-center transition">Anterior</a>
                @endif

                {{-- Botón Siguiente --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex-1 px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white text-center transition">Siguiente</a>
                @else
                    <span class="flex-1 px-5 py-2 rounded bg-primary text-white cursor-not-allowed text-center select-none">Siguiente</span>
                @endif
            </div>
        </div>

        {{-- Vista escritorio: paginación completa --}}
        <div class="hidden sm:flex flex-col sm:flex-row items-center justify-between gap-2">
            {{-- Texto personalizado --}}
            <div class="text-sm text-[#111215]">
                Se muestra página
                <span class="font-semibold text-[#111215]">{{ $paginator->currentPage() }}</span>
                de
                <span class="font-semibold text-[#111215]">{{ $paginator->lastPage() }}</span>
                @if (method_exists($paginator, 'total'))
                    — Total: <span class="font-semibold text-[#111215]">{{ $paginator->total() }}</span>
                @endif
            </div>

            {{-- Botones de paginación --}}
            <ul class="inline-flex flex-wrap items-center space-x-2">
                {{-- Botón Anterior --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="px-5 py-2 rounded bg-primary text-white cursor-not-allowed mx-0.5 select-none">Anterior</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}"
                            class="px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white transition mx-0.5">Anterior</a>
                    </li>
                @endif

                {{-- Números de página adaptativos --}}
                @php
                    $total = $paginator->lastPage();
                    $current = $paginator->currentPage();
                    $visible = 2; // Número de páginas a mostrar a cada lado
                    $start = max($current - $visible, 1);
                    $end = min($current + $visible, $total);
                @endphp

                @if ($start > 1)
                    <li>
                        <a href="{{ $paginator->url(1) }}"
                            class="px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white transition mx-0.5">1</a>
                    </li>
                    @if ($start > 2)
                        <li>
                            <span class="px-3 text-white/50 mx-0.5 select-none">...</span>
                        </li>
                    @endif
                @endif

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $current)
                        <li>
                            <span class="px-5 py-2 rounded bg-primary text-white font-bold mx-0.5 select-none">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->url($page) }}"
                                class="px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white transition mx-0.5">{{ $page }}</a>
                        </li>
                    @endif
                @endfor

                @if ($end < $total)
                    @if ($end < $total - 1)
                        <li>
                            <span class="px-3 text-white/50 mx-0.5 select-none">...</span>
                        </li>
                    @endif
                    <li>
                        <a href="{{ $paginator->url($total) }}"
                            class="px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white transition mx-0.5">{{ $total }}</a>
                    </li>
                @endif

                {{-- Botón Siguiente --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}"
                            class="px-5 py-2 rounded bg-primary hover:bg-primary/80 text-white transition mx-0.5">Siguiente</a>
                    </li>
                @else
                    <li>
                        <span class="px-5 py-2 rounded bg-primary text-white cursor-not-allowed mx-0.5 select-none">Siguiente</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
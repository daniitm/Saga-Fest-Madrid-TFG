<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Ventana flotante blanca con borde azul: Listado de tickets -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0 mb-12">
                <div class="p-6 sm:p-10">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M17 16H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h9m0 11h3a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-3m0 11v-1m0-10v1" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 20H4a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h3m6 11h3a1 1 0 0 0 1-1v-2.5M13 20v-1m4-9.999V9m0 3.001V12" />
                            </svg>
                            Listado de Tickets
                        </h2>
                    </div>
                    <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                        <x-add-button :action="route('admin.tickets.create')" :text="'Nada'" />
                    </div>
                </div>
            </div>
            <!-- Ventana flotante blanca con borde azul: Resumen y acciones -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M17 16H8a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h9m0 11h3a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-3m0 11v-1m0-10v1" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M13 20H4a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1h3m6 11h3a1 1 0 0 0 1-1v-2.5M13 20v-1m4-9.999V9m0 3.001V12" />
                            </svg>
                            Listado de Tickets
                        </h2>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6">
                        <div class="text-lg text-[#111215] font-semibold">
                            Entradas en stock: <span class="text-[#7692FF]">{{ $stock ?? 0 }}</span>
                        </div>
                        <div class="flex gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.tickets.create') }}"
                                class="bg-primary hover:bg-primary/80 text-white font-semibold px-4 py-2 rounded transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                <span class="text-2xl leading-none">+</span> Agregar entradas
                            </a>
                            <a href="{{ route('admin.tickets.delete') }}"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-md transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                <span class="text-2xl leading-none">−</span> Eliminar entradas
                            </a>
                        </div>
                    </div>
                    <!-- Precios de las entradas -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4 text-[#111215]">Precios de las entradas</h3>
                        <div class="flex flex-col gap-2">
                            @foreach($tipos as $tipo)
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-gray-100 rounded px-4 py-2 gap-2">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                        <span class="font-semibold text-[#111215]">
                                            {{ $tipo->type }} ({{ \App\Models\Ticket::where('type', $tipo->type)->count() }}):
                                        </span>
                                        <span class="text-[#7692FF] font-medium">
                                            {{ number_format($tipo->price, 2) }} €
                                        </span>
                                    </div>
                                    <a href="{{ route('admin.tickets.edit', $tipo->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-1 rounded-md transition-all duration-200 w-full sm:w-auto text-center">
                                        Editar
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
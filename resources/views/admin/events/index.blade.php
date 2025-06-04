<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Listado de Eventos
                            </h1>
                        </div>
                        <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                            <x-add-button :action="route('admin.events.create')" :text="'Agregar Evento'" />
                        </div>
                    </div>

                    @if ($events->isEmpty())
                        <div class="bg-gray-100 border border-gray-300 rounded-xl p-10 text-center shadow-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-6 opacity-80 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3.5a1.5 1.5 0 003 0H17a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay eventos registrados</h3>
                            <p class="text-gray-600 mb-6">Comienza agregando tu primer evento al sistema</p>
                        </div>
                    @else
                        <!-- Vista móvil: tarjetas -->
                        <div class="sm:hidden space-y-4 mb-6">
                            @foreach ($events as $event)
                                <div class="bg-white border border-gray-300 rounded-lg shadow p-5 flex flex-col gap-2">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-900 text-lg">Evento de {{ $event->company_name }}</span>
                                    </div>
                                    <div class="text-gray-700 text-sm flex items-center gap-2">
                                        Stand: <span class="font-semibold">{{ $event->stand_category }}</span>
                                    </div>
                                    <div class="flex gap-2 mt-2">
                                        <a href="{{ route('admin.events.show', $event) }}"
                                           class="inline-flex items-center px-3 py-1 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-xs font-semibold rounded transition duration-200">
                                            Ver más
                                        </a>
                                        <a href="{{ route('admin.events.edit', $event) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded transition duration-200">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded transition duration-200"
                                                onclick="return confirm('¿Seguro que deseas eliminar este evento?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Vista escritorio: tabla -->
                        <div class="hidden sm:block overflow-x-auto rounded-xl border border-gray-300 bg-white">
                            <table class="min-w-full w-full table-fixed divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-[#7692FF]">
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Categoría Stand</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tamaño Stand</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Espacio</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($events as $event)
                                        <tr class="hover:bg-[#7692FF]/10 transition-colors duration-200 h-16">
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $event->stand_category }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $event->stand_size }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $event->space ? $event->space->location_code : '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.events.show', $event) }}"
                                                       class="inline-flex items-center px-3 py-1 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-xs font-semibold rounded transition duration-200">
                                                        Ver más
                                                    </a>
                                                    <a href="{{ route('admin.events.edit', $event) }}"
                                                       class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded transition duration-200">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded transition duration-200"
                                                            onclick="return confirm('¿Seguro que deseas eliminar este evento?')">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-pagination :paginator="$events" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">

            <!-- Ventana flotante blanca con borde azul -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <!-- Subtítulo y botón agregar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Listado de Celebridades
                            </h1>
                        </div>
                        <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                            <x-add-button :action="route('admin.celebrities.create')" :text="'Agregar Celebridad'" />
                        </div>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('admin.celebrities.index') }}" class="mb-6 flex flex-col sm:flex-row gap-3 items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre o apellidos..." class="border border-gray-300 rounded-md px-4 py-2 w-full sm:w-80 focus:ring-primary focus:border-primary">
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-md font-semibold">Buscar</button>
                    </form>

                    @if ($celebrities->isEmpty())
                        <div class="bg-gray-100 border border-gray-300 rounded-xl p-10 text-center shadow-2xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                @if(request('search'))
                                    Celebridad no encontrada
                                @else
                                    No hay celebridades registradas
                                @endif
                            </h3>
                            @unless(request('search'))
                                <p class="text-gray-600 mb-6">Comienza agregando tu primera celebridad al sistema</p>
                            @endunless
                        </div>
                    @else
                        <!-- Vista móvil: tarjetas -->
                        <div class="sm:hidden space-y-4 mb-6">
                            @foreach ($celebrities as $celebrity)
                                <div class="bg-white border border-gray-300 rounded-lg shadow p-5 flex flex-col gap-2">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-900 text-lg">{{ ucfirst($celebrity->name) }} {{ ucfirst($celebrity->surnames) }}</span>
                                    </div>
                                    <div class="text-gray-700 text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#7692FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Categoría: <span class="font-semibold">{{ $celebrity->category }}</span>
                                    </div>
                                    <div class="flex gap-2 mt-2">
                                        <a href="{{ route('admin.celebrities.show', $celebrity) }}"
                                           class="inline-flex items-center px-3 py-1 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-xs font-semibold rounded transition duration-200">
                                            Ver más
                                        </a>
                                        <a href="{{ route('admin.celebrities.edit', $celebrity) }}"
                                           class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded transition duration-200">
                                            Editar
                                        </a>
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('admin.celebrities.destroy', $celebrity) }}')"
                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded transition duration-200">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Vista escritorio: tabla -->
                        <div class="hidden sm:block overflow-x-auto rounded-xl border border-gray-300 bg-white">
                            <table class="min-w-full w-full table-fixed divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-[#7692FF]">
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Apellidos
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Categoría
                                        </th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($celebrities as $celebrity)
                                        <tr class="hover:bg-[#7692FF]/10 transition-colors duration-200 h-16">
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ ucfirst($celebrity->name) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ ucfirst($celebrity->surnames) }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $celebrity->category }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('admin.celebrities.show', $celebrity) }}"
                                                       class="inline-flex items-center px-3 py-1 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-xs font-semibold rounded transition duration-200">
                                                        Ver más
                                                    </a>
                                                    <a href="{{ route('admin.celebrities.edit', $celebrity) }}"
                                                       class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold rounded transition duration-200">
                                                        Editar
                                                    </a>
                                                    <button type="button"
                                                        onclick="openDeleteModal('{{ route('admin.celebrities.destroy', $celebrity) }}')"
                                                        class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded transition duration-200">
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-pagination :paginator="$celebrities" />
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-delete-modal />
</x-app-layout>
<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#7692FF]" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Listado de Expositores
                        </h2>
                    </div>

                    @if ($expositors->isEmpty())
                        <div class="bg-gray-100 border border-gray-300 rounded-xl p-10 text-center shadow-2xl">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay expositores registrados</h3>
                        </div>
                    @else
                        <!-- Vista móvil: tarjetas -->
                        <div class="sm:hidden space-y-4 mb-6">
                            @foreach ($expositors as $expositor)
                                <div class="bg-white border border-gray-300 rounded-lg shadow p-5 flex flex-col gap-2">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-900 text-lg">{{ ucfirst($expositor->name) }}</span>
                                    </div>
                                    <div class="text-gray-700 text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#7692FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $expositor->email }}
                                    </div>
                                    <div class="text-gray-700 text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#7692FF]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />
                                        </svg>
                                        {{ $expositor->phone }}
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
                                            Email
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($expositors as $expositor)
                                        <tr class="hover:bg-[#7692FF]/10 transition-colors duration-200 h-16">
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $expositor->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $expositor->email }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $expositor->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $expositors->links('components.pagination') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

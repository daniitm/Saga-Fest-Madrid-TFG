<x-app-layout>
    <div class="min-h-screen py-6 sm:py-12 flex items-start justify-center" style="background: linear-gradient(to bottom, #f3f4f6 0%, #e5e7eb 100%); min-height: 100dvh;">
        <div class="w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Ventana flotante blanca con borde azul -->
            <div class="bg-white rounded-2xl shadow-2xl border-2 border-[#7692FF] p-0">
                <div class="p-6 sm:p-10">
                    <!-- Subtítulo -->
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#111215] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Listado de Horarios
                        </h2>
                    </div>
                    @if ($schedules->isEmpty())
                        <div class="bg-gray-100 border border-gray-300 rounded-xl p-10 text-center shadow-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-6 opacity-80 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay horarios registrados</h3>
                            <p class="text-gray-600 mb-6">Comienza agregando tu primer horario al sistema</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-6">
                            @php
                                $dias = $schedules->groupBy(function($item) {
                                    return \Carbon\Carbon::parse($item->turn->date)->format('Y-m-d');
                                });
                                $dias = $dias->sortKeys();
                                $dias = $dias->map(function($turnos) {
                                    return $turnos->sortBy(function($item) {
                                        return $item->turn->name === 'Mañana' ? 0 : 1;
                                    });
                                });
                            @endphp
                            @foreach($dias as $fechaKey => $turnos)
                                <div>
                                    <div class="text-lg font-bold text-[#111215] mb-2 flex items-center gap-2">
                                        {{ \Carbon\Carbon::parse($fechaKey)->format('d/m/Y') }}
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        @foreach($turnos as $schedule)
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-gray-100 rounded px-4 py-2 gap-2">
                                                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                                                    <span class="font-semibold text-[#111215]">{{ $schedule->turn->name }}:</span>
                                                    <span class="text-[#7692FF] font-medium">
                                                        {{ \Carbon\Carbon::parse($schedule->turn->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->turn->end_time)->format('H:i') }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('admin.schedules.edit-turn', $schedule) }}"
                                                   class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-1 rounded transition-all duration-200 w-full sm:w-auto text-center">
                                                    Editar
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <!-- Minutos de descanso -->
                    <div class="mt-6 flex flex-col gap-2">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <div class="text-lg text-[#111215] font-semibold">
                                Intervalo de descanso entre eventos: <span class="text-[#7692FF]">{{ $schedules->first()->break ?? 0 }} minutos</span>
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <a href="{{ route('admin.schedules.edit-break', $schedule) }}"
                                class="bg-primary hover:bg-primary/80 text-white font-semibold px-4 py-2 rounded transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                    <span class="text-2xl leading-none">✎</span> Editar descanso
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
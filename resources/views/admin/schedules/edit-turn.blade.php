<x-app-layout>
    <div class="py-8 sm:py-12 bg-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-xl border-2 border-[#7692FF] p-8">
                <h1 class="text-2xl font-bold text-[#111215] mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#7692FF]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Editar Horario del Turno
                </h1>
                @if($eventsCount > 0)
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3500)"
                        class="fixed top-6 right-6 z-50 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 px-6 py-4 rounded shadow-lg flex items-center gap-2 transition-all duration-300">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>No se puede editar el horario porque ya existe al menos un evento creado.</span>
                    </div>
                @else
                <form method="POST" action="{{ route('admin.schedules.updateTurn', $schedule) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Turno</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" value="{{ $schedule->turn->name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de inicio</label>
                        <input type="time" id="start_time" name="start_time" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $schedule->turn->start_time }}">
                        @error('start_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de fin</label>
                        <input type="time" id="end_time" name="end_time" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ $schedule->turn->end_time }}">
                        @error('end_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-8 flex gap-3">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-base font-semibold rounded transition duration-200">Guardar cambios</button>
                        <a href="{{ route('admin.schedules.index') }}"
                            class="inline-flex items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-base font-semibold rounded transition duration-200">
                            Cancelar
                        </a>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@php
    $isEdit = isset($event);
    // Remove hardcoded $allowedDates and $turnos
    // Use $allowedDates and $turns from controller
    $selectedDate = old('date', $isEdit ? ($event->schedule->turn->date ?? '') : '');
    $selectedTurno = old('turno', $isEdit ? ($event->schedule->turn->name ?? '') : '');
    $selectedStart = old('start_time', $isEdit ? ($event->event_start_time ?? '') : '');
    $selectedEnd = old('end_time', $isEdit ? ($event->event_end_time ?? '') : '');
    $selectedCelebrities = old('celebrities');
    if (is_null($selectedCelebrities)) {
        $selectedCelebrities = $isEdit ? $event->celebrities->pluck('id')->toArray() : [];
    }
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.events.update', $event) : route('admin.events.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <!-- Información del solicitante -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Información del solicitante:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Empresa -->
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                <input type="text" name="company_name" id="company_name"
                    value="{{ old('company_name', $event->company_name ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('company_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Persona de contacto -->
            <div>
                <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">Persona de contacto *</label>
                <input type="text" name="contact_person" id="contact_person"
                    value="{{ old('contact_person', $event->contact_person ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('contact_person')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input name="email" id="email"
                    value="{{ old('email', $event->email ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Teléfono -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono *</label>
                <input type="text" name="phone" id="phone"
                    value="{{ old('phone', $event->phone ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Web -->
            <div>
                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Web</label>
                <input name="website" id="website"
                    value="{{ old('website', $event->website ?? '') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('website')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Categoría Stand -->
            <div>
                <label for="stand_category" class="block text-sm font-medium text-gray-700 mb-1">Categoría Stand *</label>
                <select name="stand_category" id="stand_category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona una categoría</option>
                    @foreach([
                        'Editoriales',
                        'Productoras / Plataformas',
                        'Videojuegos',
                        'Merchandising',
                        'Artistas / Creadores',
                        'Cosplay',
                        'Educación',
                        'Asociaciones'
                    ] as $cat)
                        <option value="{{ $cat }}" @selected(old('stand_category', $event->stand_category ?? '') === $cat)>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('stand_category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Preferencias del Stand -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Preferencias del Stand:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tamaño Stand -->
            <div>
                <label for="stand_size" class="block text-sm font-medium text-gray-700 mb-1">Tamaño Stand *</label>
                <select name="stand_size" id="stand_size"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona un tamaño</option>
                    @foreach(['Pequeño', 'Medio', 'Grande'] as $size)
                        <option value="{{ $size }}" @selected(old('stand_size', $event->stand_size ?? '') === $size)>
                            {{ $size }}
                        </option>
                    @endforeach
                </select>
                @error('stand_size')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Necesidades Técnicas y Logísticas -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Necesidades Técnicas y Logísticas:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Internet cableado -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-1">Internet cableado *</span>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="wired_internet" value="1" id="wired_internet_yes"
                            class="h-5 w-5 text-[#7692FF] border-gray-300 focus:ring-[#7692FF]"
                            {{ old('wired_internet', $event->wired_internet ?? null) == 1 ? 'checked' : '' }}>
                        <span>Sí</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="wired_internet" value="0" id="wired_internet_no"
                            class="h-5 w-5 text-[#7692FF] border-gray-300 focus:ring-[#7692FF]"
                            {{ old('wired_internet', $event->wired_internet ?? null) == 0 ? 'checked' : '' }}>
                        <span>No</span>
                    </label>
                </div>
                @error('wired_internet')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Configuración de sonido -->
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-1">Configuración de sonido *</span>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="audio_sound_configuration" value="1" id="audio_sound_configuration_yes"
                            class="h-5 w-5 text-[#7692FF] border-gray-300 focus:ring-[#7692FF]"
                            {{ old('audio_sound_configuration', $event->audio_sound_configuration ?? null) == 1 ? 'checked' : '' }}>
                        <span>Sí</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="audio_sound_configuration" value="0" id="audio_sound_configuration_no"
                            class="h-5 w-5 text-[#7692FF] border-gray-300 focus:ring-[#7692FF]"
                            {{ old('audio_sound_configuration', $event->audio_sound_configuration ?? null) == 0 ? 'checked' : '' }}>
                        <span>No</span>
                    </label>
                </div>
                @error('audio_sound_configuration')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Horario -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Horario:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Fecha -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Fecha *</label>
                <select name="date" id="date" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona una fecha</option>
                    @foreach($allowedDates as $dateOpt)
                        <option value="{{ $dateOpt }}" {{ $selectedDate === $dateOpt ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($dateOpt)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Turno -->
            <div>
                <label for="turno" class="block text-sm font-medium text-gray-700 mb-1">Turno *</label>
                <select name="turno" id="turno" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona un turno</option>
                </select>
                @error('turno')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Hora de inicio -->
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de inicio *</label>
                <input type="time" name="start_time" id="start_time"
                    value="{{ $selectedStart }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('start_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Hora de fin -->
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Hora de fin *</label>
                <input type="time" name="end_time" id="end_time"
                    value="{{ $selectedEnd }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                @error('end_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Celebridades del Evento -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Celebridades del Evento:</h3>
        <div id="celebrities-container" style="display:none">
            <label for="celebrities" class="block text-sm font-medium text-gray-700 mb-1">
                Celebridades *
                <span id="celebrities-count" class="text-xs text-gray-500 ml-2">(0/5 seleccionadas)</span>
            </label>
            <select name="celebrities[]" id="celebrities" multiple
                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                size="8">
                @foreach($celebrities as $celeb)
                    <option value="{{ $celeb->id }}"
                        @if(isset($selectedCelebrities) && in_array($celeb->id, $selectedCelebrities)) selected @endif>
                     {{ $celeb->name }} {{ $celeb->surnames }} ({{ $celeb->category }})
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-1">Puedes seleccionar hasta 5 celebridades.</p>
        </div>
        <div id="celebrities-help" class="text-gray-500 text-sm" style="display:block">
            Selecciona primero la fecha, el turno y las horas para ver las celebridades disponibles.
        </div>
    </div>

    <!-- Imagen del Evento -->
    <div class="mb-8">
       <h3 class="text-lg font-bold text-[#7692FF] mb-4">Imagen del Evento:</h3>   
        <div class="flex items-center gap-3">
            <input type="file" name="image" id="image"
                class="hidden"
                onchange="updateFileName(this)">
            <label for="image"
                class="inline-block px-4 py-2 bg-gray-200 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-300 transition duration-150">
                Seleccionar archivo
            </label>
            <span id="file-name" class="text-sm text-gray-600">
                @if(isset($event) && $event->image && $event->image !== 'imagen_perfil.png')
                    {{ $event->image }}
                @else
                    Ningún archivo seleccionado
                @endif
            </span>
        </div>                
        @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Breve Descripción -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Breve descripción del Evento:</h3>
        <label class="block text-sm font-medium text-gray-700 mb-1">Breve descripción *</label>
        <textarea name="short_description" id="short_description" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Entre 100 y 255 caracteres">{{ old('short_description', $event->short_description ?? '') }}</textarea>
        <p class="text-xs text-gray-500">Mínimo 100 y máximo 255 caracteres.</p>
        @error('short_description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Descripción del Evento -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Descripción del Evento:</h3>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción *</label>
        <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Mínimo 1000 caracteres">{{ old('description', $event->description ?? '') }}</textarea>
        <p class="text-xs text-gray-500">Mínimo 1000 caracteres.</p>
        @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tipo de Evento -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-[#7692FF] mb-4">Tipo de Evento:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo *</label>
                <select name="type" id="type" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona un tipo</option>
                    @foreach(['General', 'Premium'] as $typeOpt)
                        <option value="{{ $typeOpt }}" @selected(old('type', $event->type ?? '') === $typeOpt)>{{ $typeOpt }}</option>
                    @endforeach
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="mt-8 flex gap-3">
        <button type="submit"
            class="inline-flex items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-base font-semibold rounded transition duration-200">
            {{ $isEdit ? 'Guardar cambios' : 'Agregar' }}
        </button>
        <a href="{{ route('admin.events.index') }}"
            class="inline-flex items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-base font-semibold rounded transition duration-200">
            Cancelar
        </a>
    </div>
</form>

<div id="turns-data" data-turns='@json($turns)'></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const turns = JSON.parse(document.getElementById('turns-data').getAttribute('data-turns'));
    const dateSelect = document.getElementById('date');
    const turnoSelect = document.getElementById('turno');
    const startTime = document.getElementById('start_time');
    const endTime = document.getElementById('end_time');
    const selectedTurno = "{{ $selectedTurno }}";
    const selectedDate = "{{ $selectedDate }}";
    // Celebridades
    const token = document.querySelector('meta[name="celebrity-event-token"]')?.getAttribute('content');
    const celebritiesSelect = document.getElementById('celebrities');
    const celebritiesCount = document.getElementById('celebrities-count');
    function updateCelebritiesCount() {
        const selected = Array.from(celebritiesSelect.selectedOptions).length;
        celebritiesCount.textContent = `(${selected}/5 seleccionadas)`;
        if (selected > 5) {
            celebritiesSelect.selectedOptions[selected-1].selected = false;
            updateCelebritiesCount();
        }
    }
    celebritiesSelect.addEventListener('change', updateCelebritiesCount);
    updateCelebritiesCount();

    function updateTurnos() {
        const currentDate = dateSelect.value;
        turnoSelect.innerHTML = '<option value="">Selecciona un turno</option>';
        if (turns[currentDate]) {
            Object.keys(turns[currentDate]).forEach(function(turnName) {
                const option = document.createElement('option');
                option.value = turnName;
                option.text = turnName + ' (' + turns[currentDate][turnName].start + ' - ' + turns[currentDate][turnName].end + ')';
                if (turnName === selectedTurno && currentDate === selectedDate) {
                    option.selected = true;
                }
                turnoSelect.appendChild(option);
            });
        }
        startTime.value = '';
        endTime.value = '';
        startTime.min = startTime.max = endTime.min = endTime.max = '';
    }

    function updateHoras() {
        const currentDate = dateSelect.value;
        const selectedTurnoValue = turnoSelect.value;
        if (turns[currentDate] && turns[currentDate][selectedTurnoValue]) {
            const t = turns[currentDate][selectedTurnoValue];
            startTime.min = t.start;
            startTime.max = t.end;
            endTime.min = t.start;
            endTime.max = t.end;
        } else {
            startTime.min = startTime.max = endTime.min = endTime.max = '';
        }
        startTime.value = '';
        endTime.value = '';
    }

    dateSelect.addEventListener('change', function() {
        updateTurnos();
        updateHoras();
    });
    turnoSelect.addEventListener('change', updateHoras);

    // Nueva función para controlar la visibilidad de celebridades
    function checkCelebritiesVisibility() {
        const hasAll = dateSelect.value && turnoSelect.value && startTime.value && endTime.value;
        document.getElementById('celebrities-container').style.display = hasAll ? 'block' : 'none';
        document.getElementById('celebrities-help').style.display = hasAll ? 'none' : 'block';
        if (hasAll) {
            loadAvailableCelebrities();
        }
    }
    dateSelect.addEventListener('change', checkCelebritiesVisibility);
    turnoSelect.addEventListener('change', checkCelebritiesVisibility);
    startTime.addEventListener('change', checkCelebritiesVisibility);
    endTime.addEventListener('change', checkCelebritiesVisibility);
    checkCelebritiesVisibility();

    async function loadAvailableCelebrities() {
        const date = dateSelect.value;
        const turno = turnoSelect.value;
        const start = startTime.value;
        const end = endTime.value;
        if (!date || !turno || !start || !end) return;
        const url = `/admin/events/available-celebrities?date=${encodeURIComponent(date)}&turn_name=${encodeURIComponent(turno)}&start_time=${encodeURIComponent(start)}&end_time=${encodeURIComponent(end)}`;
        const select = document.getElementById('celebrities');
        select.innerHTML = '<option disabled>Cargando...</option>';
        try {
            const res = await fetch(url, {
                method: 'GET',
                headers: {
                    'Celebrity-Event-Token': window.CELEBRITY_EVENT_TOKEN
                }
            });
            if (!res.ok) throw new Error('Error al cargar celebridades');
            const data = await res.json();
            select.innerHTML = '';
            data.forEach(function(celeb) {
                const option = document.createElement('option');
                option.value = celeb.id;
                option.text = `${celeb.name} ${celeb.surnames} (${celeb.category})`;
                select.appendChild(option);
            });
        } catch (e) {
            select.innerHTML = '<option disabled>Error al cargar celebridades</option>';
        }
    }

    // Inicialización en caso de edición o recarga por error
    updateTurnos();
    if (turnoSelect.value) {
        updateHoras();
    }
    if (startTime && endTime && "{{ $isEdit }}") {
        startTime.value = "{{ $selectedStart }}";
        endTime.value = "{{ $selectedEnd }}";
    }
});
</script>

<script>
function updateFileName(input) {
    const fileNameSpan = document.getElementById('file-name');
    if (input.files.length > 0) {
        fileNameSpan.textContent = input.files[0].name;
    } else {
        fileNameSpan.textContent = 'Ningún archivo seleccionado';
    }
}
</script>
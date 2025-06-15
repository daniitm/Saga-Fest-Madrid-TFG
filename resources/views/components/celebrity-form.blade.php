@php
    $isEdit = isset($celebrity);
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.celebrities.update', $celebrity) : route('admin.celebrities.store') }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
            <input type="text" name="name" id="name"
                value="{{ old('name', $celebrity->name ?? '') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Apellidos -->
        <div>
            <label for="surnames" class="block text-sm font-medium text-gray-700 mb-1">Apellidos *</label>
            <input type="text" name="surnames" id="surnames"
                value="{{ old('surnames', $celebrity->surnames ?? '') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
            @error('surnames')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input name="email" id="email"
                value="{{ old('email', $celebrity->email ?? '') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Categoría -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Categoría *</label>
            <select name="category" id="category"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
                <option value="">Selecciona una categoría</option>
                @foreach([
                    'Actores / Actrices',
                    'Dibujantes / Ilustradores',
                    'Guionistas / Creadores',
                    'Desarrolladores / Diseñadores',
                    'Productores / Directores / Compositores',
                    'Influencers / YouTubers / Streamers'
                ] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $celebrity->category ?? '') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('category')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Website -->
        <div>
            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Web / Redes</label>
            <input name="website" id="website"
                value="{{ old('website', $celebrity->website ?? '') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150" autocomplete="off">
            @error('website')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Foto -->
        <div class="md:col-span-2">
            <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto de perfil</label>
            <div class="flex items-center gap-3">
                <input type="file" name="photo" id="photo"
                    class="hidden"
                    onchange="updateFileName(this)">
                <label for="photo"
                    class="inline-block px-4 py-2 bg-gray-200 border border-gray-300 rounded-md cursor-pointer hover:bg-gray-300 transition duration-150">
                    Seleccionar archivo
                </label>
                <span id="file-name" class="text-sm text-gray-600">
                    @if(isset($celebrity) && $celebrity->photo && $celebrity->photo !== 'imagen_perfil.png')
                        {{ $celebrity->photo }}
                    @else
                        Ningún archivo seleccionado
                    @endif
                </span>
            </div>
            @error('photo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <!-- Biografía -->
        <div class="md:col-span-2">
            <label for="biography" class="block text-sm font-medium text-gray-700 mb-1">Biografía *</label>
            <textarea name="biography" id="biography"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary transition duration-150" autocomplete="off">{{ old('biography', $celebrity->biography ?? '') }}</textarea>
            @error('biography')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-8 flex gap-3">
        <button type="submit"
            class="inline-flex items-center px-6 py-2 bg-[#7692FF] hover:bg-[#1B2CC1] text-white text-base font-semibold rounded transition duration-200">
            {{ $isEdit ? 'Guardar cambios' : 'Agregar' }}
        </button>
        <a href="{{ route('admin.celebrities.index') }}"
            class="inline-flex items-center px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-base font-semibold rounded transition duration-200">
            Cancelar
        </a>
    </div>
</form>

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
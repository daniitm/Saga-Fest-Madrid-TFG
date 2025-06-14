<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                <h3 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">¿Quieres exponer?</h3>
                <p class="text-gray-200 text-base leading-relaxed mb-6 text-center">
                    Déjanos tus datos y nos pondremos en contacto contigo para la elaboración de tu exposición. Debes tener en cuenta que poseemos unos horarios limitados por lo que tendrás que adaptarte a dichos horarios.
               </p>
                <form method="POST" action="{{ route('want-expose.submit') }}" enctype="multipart/form-data" class="space-y-14">
                    @csrf
                    <!-- Información del solicitante -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Información del solicitante:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <label for="company" class="block text-base font-medium text-gray-200 mb-2">Empresa *</label>
                                <input id="company" name="company" type="text" value="{{ old('company') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                                @error('company')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="contact_person" class="block text-base font-medium text-gray-200 mb-2">Persona de contacto *</label>
                                <input id="contact_person" name="contact_person" type="text" value="{{ old('contact_person') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                                @error('contact_person')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-6">
                            <div>
                                <label for="email" class="block text-base font-medium text-gray-200 mb-2">Email *</label>
                                <input id="email" name="email" value="{{ old('email') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-base font-medium text-gray-200 mb-2">Teléfono *</label>
                                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-6">
                            <div>
                                <label for="website" class="block text-base font-medium text-gray-200 mb-2">Web / Redes</label>
                                <input id="website" name="website" value="{{ old('website') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                                @error('website')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="stand_category" class="block text-base font-medium text-gray-200 mb-2">Categoría de stand *</label>
                                <select id="stand_category" name="stand_category" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">
                                    <option value="">Selecciona una categoría</option>
                                    <option value="editoriales" {{ old('stand_category') == 'editoriales' ? 'selected' : '' }}>Editoriales</option>
                                    <option value="productoras/plataformas" {{ old('stand_category') == 'productoras/plataformas' ? 'selected' : '' }}>Productoras / Plataformas</option>
                                    <option value="videojuegos" {{ old('stand_category') == 'videojuegos' ? 'selected' : '' }}>Videojuegos</option>
                                    <option value="merchandising" {{ old('stand_category') == 'merchandising' ? 'selected' : '' }}>Merchandising</option>
                                    <option value="artistas/creadores" {{ old('stand_category') == 'artistas/creadores' ? 'selected' : '' }}>Artistas / Creadores</option>
                                    <option value="cosplay" {{ old('stand_category') == 'cosplay' ? 'selected' : '' }}>Cosplay</option>
                                    <option value="educacion" {{ old('stand_category') == 'educacion' ? 'selected' : '' }}>Educación</option>
                                    <option value="asociaciones" {{ old('stand_category') == 'asociaciones' ? 'selected' : '' }}>Asociaciones</option>
                                </select>
                                @error('stand_category')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>  
                    </div>

                    <!-- Preferencias del stand -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Preferencias del Stand:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <label for="stand_size" class="block text-base font-medium text-gray-200 mb-2">Tamaño de stand *</label>
                                <select id="stand_size" name="stand_size" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">
                                    <option value="">Selecciona un tamaño</option>
                                    <option value="pequeño" {{ old('stand_size') == 'pequeño' ? 'selected' : '' }}>Pequeño</option>
                                    <option value="mediano" {{ old('stand_size') == 'medio' ? 'selected' : '' }}>Medio</option>
                                    <option value="grande" {{ old('stand_size') == 'grande' ? 'selected' : '' }}>Grande</option>
                                </select>
                                @error('stand_size')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Necesidades Técnicas y Logísticas -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Necesidades Técnicas y Logísticas:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-6">
                            <div>
                                <label class="block text-base font-medium text-gray-200 mb-2">Internet cableado *</label>
                                <div class="flex flex-row gap-6 mb-6 w-full max-w-md">
                                    <label class="flex items-center gap-3 cursor-pointer select-none">
                                        <input type="radio" id="wired_internet_si" name="wired_internet" value="si" class="accent-primary mt-1 scale-125" {{ old('wired_internet', 'no') == 'si' ? 'checked' : '' }} required />
                                        <span class="text-white text-base leading-snug">Sí</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer select-none">
                                        <input type="radio" id="wired_internet_no" name="wired_internet" value="no" class="accent-primary mt-1 scale-125" {{ old('wired_internet', 'no') == 'no' ? 'checked' : '' }} required />
                                        <span class="text-white text-base leading-snug">No</span>
                                    </label>
                                </div>
                                @error('wired_internet')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="sound_setup" class="block text-base font-medium text-gray-200 mb-2">Configuración de sonido *</label>
                                <div class="flex flex-row gap-6 mb-6 w-full max-w-md">
                                    <label class="flex items-center gap-3 cursor-pointer select-none">
                                        <input type="radio" id="sound_setup_si" name="sound_setup" value="si" class="accent-primary mt-1 scale-125" {{ old('sound_setup', 'no') == 'si' ? 'checked' : '' }} required />
                                        <span class="text-white text-base leading-snug">Sí</span>
                                    </label>
                                    <label class="flex items-center gap-3 cursor-pointer select-none">
                                        <input type="radio" id="sound_setup_no" name="sound_setup" value="no" class="accent-primary mt-1 scale-125" {{ old('sound_setup', 'no') == 'no' ? 'checked' : '' }} required />
                                        <span class="text-white text-base leading-snug">No</span>
                                    </label>
                                </div>
                                @error('sound_setup')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Breve descripción -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Breve descripción de la Exposición:</h4>
                        <div class="mt-6">
                            <label for="short_description" class="block text-base font-medium text-gray-200 mb-2">Breve descripción *</label>
                            <textarea id="short_description" name="short_description" rows="4" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Requerimientos especiales -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Requerimientos especiales:</h4>
                        <div class="mt-6">
                            <label for="special_requirements" class="block text-base font-medium text-gray-200 mb-2">Requerimientos especiales</label>
                            <textarea id="special_requirements" name="special_requirements" rows="4" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">{{ old('special_requirements') }}</textarea>
                            @error('special_requirements')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Información adicional -->
                    <div class="mb-10">
                        <h4 class="text-xl font-bold text-white mb-6 border-b border-[#7692FF] pb-2">Información adicional:</h4>
                        <div class="mt-6">
                            <label for="additional_information" class="block text-base font-medium text-gray-200 mb-2">Información adicional</label>
                            <textarea id="additional_information" name="additional_information" rows="4" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">{{ old('special_requirements') }}</textarea>
                            @error('additional_information')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-3 px-10 rounded-full transition text-lg shadow-lg w-full max-w-xs">Enviar solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>

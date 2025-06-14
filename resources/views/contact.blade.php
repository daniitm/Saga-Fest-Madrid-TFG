<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl w-full max-w-xl" style="background-color: #363636;">
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-8 text-center">Contacto</h3>
                <p class="text-gray-200 text-base leading-relaxed mb-6 text-center">
                    En caso de que tenga alguna pregunta, sugerencia o necesite ayuda, rellene este formulario y nos pondremos en contacto contigo lo antes posible.
                </p>
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-base font-medium text-gray-200 mb-2">Nombre *</label>
                        <input id="name" name="name" type="text" value="{{ old('name', auth()->user()?->name) }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="surnames" class="block text-base font-medium text-gray-200 mb-2">Apellidos *</label>
                        <input id="surnames" name="surnames" type="text" value="{{ old('surnames', auth()->user()?->surnames) }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                        @error('surnames')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-base font-medium text-gray-200 mb-2">Email *</label>
                        <input id="email" name="email" value="{{ old('email', auth()->user()?->email) }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="block text-base font-medium text-gray-200 mb-2">Teléfono</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4" />
                        @error('phone')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-10">
                        <label for="message" class="block text-base font-medium text-gray-200 mb-2">Mensaje *</label>
                        <textarea id="message" name="message" rows="5" class="block w-full rounded-lg bg-[#232323] text-white border-[#7692FF] placeholder-gray-400 focus:border-[#1B2CC1] focus:ring-[#1B2CC1] shadow-sm py-3 px-4">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-primary hover:bg-primary/80 text-white font-bold py-3 px-10 rounded-full transition text-lg shadow-lg w-full max-w-xs">Enviar mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>
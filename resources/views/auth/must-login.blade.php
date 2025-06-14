<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-gray-50 rounded-2xl p-8 sm:p-10 shadow-2xl w-full max-w-md" style="background-color: #363636;">
                <div class="flex flex-col items-center">
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">
                        Acceso requerido
                    </h1>
                    <p class="text-gray-200 text-base leading-relaxed mb-4 text-center">
                        Para continuar, necesitas iniciar sesión o crear una cuenta en nuestra página web.
                    </p>
                    <p class="text-gray-200 text-base leading-relaxed mb-6 text-center">
                        Si ya tienes una cuenta, inicia sesión. Si no, regístrate para acceder al contenido.
                    </p>
                    <div class="w-full flex flex-col gap-3">
                        <a href="{{ route('login') }}"
                           class="w-full text-center bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}"
                           class="w-full text-center bg-primary hover:bg-primary/80 text-white font-semibold px-8 py-3 rounded-full shadow transition-all duration-300">
                            Registrarse
                        </a>
                    </div>
                    <div class="h-4"></div>
                    <p class="text-gray-400 mb-4 text-sm  text-center">
                        ¿Problemas para acceder? <a href="{{ route('contact') }}" class="underline hover:text-[#7692FF]">Contacta con nosotros</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>
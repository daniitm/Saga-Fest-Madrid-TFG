<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
            <div class="bg-gray-50 rounded-2xl p-8 sm:p-12 shadow-2xl" style="background-color: #363636;">
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">Preguntas Frecuentes</h1>
                <div class="space-y-6">
                    <!-- Pregunta 1 -->
                    <div class="bg-[#232323] rounded-xl p-6">
                        <button type="button" class="flex items-center justify-between w-full text-left text-white text-lg font-semibold focus:outline-none" onclick="toggleFaq(1)">
                            ¿Cuándo y dónde se celebrará el Saga-Fest Madrid?
                            <svg id="arrow-1" class="w-6 h-6 min-w-6 min-h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="answer-1" class="mt-4 text-gray-300 hidden">
                            Saga-Fest Madrid se celebrará del 25 al 27 de julio en IFEMA MADRID (Av. del Partenón, 5, Barajas, 28042 Madrid). Se utilizarán los pabellones 5 (C1) y 6 (C2) junto con el patio exterior que los separa (P0). La apertura de puertas será a las 08:30h y el cierre a las 21:00h, aunque el horario puede variar dependiendo de la programación de actividades, consulte todos estos datos actualizados en la sección de "Dónde se desarrolla".
                        </div>
                    </div>
                    <!-- Pregunta 2 -->
                    <div class="bg-[#232323] rounded-xl p-6">
                        <button type="button" class="flex items-center justify-between w-full text-left text-white text-lg font-semibold focus:outline-none" onclick="toggleFaq(2)">
                            ¿Qué tengo que hacer para asistir al Saga-Fest Madrid?
                            <svg id="arrow-2" class="w-6 h-6 min-w-6 min-h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="answer-2" class="mt-4 text-gray-300 hidden">
                            Para asistir al Saga-Fest Madrid debes:
                            <ul class="list-disc list-inside">
                                <li>Primero tener una cuenta registrada en nuestro sitio web.</li>
                                <li>Una vez tengas tu cuenta, tienes que iniciar sesión y dirigirte a la sección de "Quiero asistir".</li>
                                <li>Selecciona el tipo y cantidad de entradas (recuerda que solo podrás comprar un máximo de 5 entradas), realizar el pago y recibirás un correo de confirmación.</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Pregunta 3 -->
                    <div class="bg-[#232323] rounded-xl p-6">
                        <button type="button" class="flex items-center justify-between w-full text-left text-white text-lg font-semibold focus:outline-none" onclick="toggleFaq(3)">
                            ¿Pueden ir menores de edad al Saga-Fest Madrid?
                            <svg id="arrow-3" class="w-6 h-6 min-w-6 min-h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="answer-3" class="mt-4 text-gray-300 hidden">
                            Sí, los menores de 14 años podrán ir al Saga-Fest Madrid pero deberán ir acompañados de un adulto que se haga responsable de ellos, por lo que no tendrán que comprar entrada. 
                            Mientras que los mayores de 14 años podrán ir sin la necesidad de ir acompañados de un adulto, pero estos si tendrán que comprar entrada.
                        </div>
                    </div>
                    <!-- Pregunta 4 -->
                    <div class="bg-[#232323] rounded-xl p-6">
                        <button type="button" class="flex items-center justify-between w-full text-left text-white text-lg font-semibold focus:outline-none" onclick="toggleFaq(4)">
                            ¿Qué hacer si he comprado entradas y no he recibido ninguna confirmación?
                            <svg id="arrow-4" class="w-6 h-6 min-w-6 min-h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="answer-4" class="mt-4 text-gray-300 hidden">
                            En caso de haber realizado la compra de las entradas y no haber recibido ninguna confirmación, te recomendamos que revises tu carpeta de spam o correo no deseado. Si aún así no encuentras el correo, por favor contacta con nuestro equipo de soporte a través de la sección de contacto de nuestra página web.
                        </div>
                    </div>
                    <!-- Pregunta 5 -->
                    <div class="bg-[#232323] rounded-xl p-6">
                        <button type="button" class="flex items-center justify-between w-full text-left text-white text-lg font-semibold focus:outline-none" onclick="toggleFaq(5)">
                            ¿Qué diferencia hay entre la entrada General y la Premium?
                            <svg id="arrow-5" class="w-6 h-6 min-w-6 min-h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="answer-5" class="mt-4 text-gray-300 hidden">
                            La entrada General incluye acceso a todos los eventos de caracter general mientras que la entrada Premium incluye acceso a todos los eventos contando no solo con los generales sino con los exclusivos, asiento reservado, regalo exclusivo y acceso prioritario a actividades especiales.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function toggleFaq(num) {
            const total = 5;
            for (let i = 1; i <= total; i++) {
                const answer = document.getElementById('answer-' + i);
                const arrow = document.getElementById('arrow-' + i);
                if (i === num) {
                    const isOpen = !answer.classList.contains('hidden');
                    if (isOpen) {
                        answer.classList.add('hidden');
                        arrow.style.transform = '';
                    } else {
                        answer.classList.remove('hidden');
                        arrow.style.transform = 'rotate(180deg)';
                    }
                } else {
                    answer.classList.add('hidden');
                    arrow.style.transform = '';
                }
            }
        }
    </script>
    <x-footer />
</x-app-layout>

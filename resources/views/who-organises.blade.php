<x-app-layout>
    <section class="bg-white py-14 sm:py-20 lg:py-22" style="background-color: #111215;">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
            <div class="bg-gray-50 rounded-2xl p-10 sm:p-14 shadow-2xl" style="background-color: #363636;">
                <h3 class="text-4xl sm:text-5xl font-bold text-white mb-10 text-center">¿Quién organiza?</h3>

                <p class="text-white text-lg mb-6">
                    Saga-Fest Madrid es un festival anual que celebra la creatividad y la diversidad del entretenimiento visual, reuniendo a librerías, editoriales, aficionados, creadores y profesionales del mundo del cómic, las series, el cine, los videojuegos y la ilustración.
                    Organizado por el Ayuntamiento de Madrid y la Asociación de Librerías de Madrid, junto con el apoyo del Ministerio de Cultura y Deporte además de la colaboración de la Casa del Lector. Saga-Fest Madrid tiene como objetivo fomentar la cultura pop, conectar a profesionales de distintas disciplinas y acercar estas formas de arte y narración a nuevos públicos.
                </p>
                <div class="flex justify-center mb-10">
                    <img src="/assets/images/quienorganiza.png" alt="Quién organiza Saga-Fest Madrid" class="h-full w-full max-w-4xl object-cover rounded-2xl shadow-2xl">
                </div>

                <!-- Sección colaboradores -->
                <div class="mb-12">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="flex flex-col items-center">
                            <h2 class="text-2xl font-bold text-white mb-4 text-center sm:hidden">Ayuntamiento de Madrid</h2>
                            <a href="https://www.madrid.es/portal/site/munimadrid" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/ayuntamientomadrid.png" alt="Ayuntamiento de Madrid" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="hidden sm:block text-2xl font-bold text-white mt-4">Ayuntamiento de Madrid</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <h2 class="text-2xl font-bold text-white mb-4 text-center sm:hidden">Ministerio de Cultura y Deporte</h2>
                            <a href="https://www.cultura.gob.es/portada.html" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/ministerioculturadeporte.png" alt="Ministerio de Cultura y Deporte" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="hidden sm:block text-2xl font-bold text-white mt-4">Ministerio de Cultura y Deporte</span>
                        </div>
                    </div>
                </div>

                <!-- Sección nuestro equipo y valores -->
                <div class="flex flex-col gap-10 my-16">
                    <div class="w-full">
                        <h4 class="text-2xl font-bold text-white mb-4">Nuestro equipo y valores:</h4>
                        <p class="text-white text-lg mb-4">
                            El equipo de Saga-Fest Madrid está formado por profesionales y entusiastas de la cultura pop en todas sus vertientes: cómic, ilustración, literatura fantástica, cine, series y videojuegos. Nos une la pasión por la creatividad, la diversidad y la innovación en el ámbito del entretenimiento y la cultura visual.
                        </p>
                        <p class="text-white text-lg mb-4">
                            Con el apoyo de instituciones, patrocinadores y voluntarios, trabajamos para ofrecer una experiencia única y enriquecedora a todos los asistentes, expositores y artistas invitados. Nuestro equipo está dedicado a hacer de Saga-Fest Madrid un evento inolvidable que celebre la cultura pop en todas sus formas.
                        </p>
                    </div>
                    <div class="flex flex-col md:flex-row gap-10 w-full">
                        <div class="md:w-1/2 w-full">
                            <p class="text-white text-lg mb-4">
                                Gracias a la colaboración con IFEMA MADRID y el apoyo de su equipo oficial, este festival será posible. Saga-Fest Madrid ocupará los pabellones 5 (C1) y 6 (C2) de IFEMA, así como parte el patio (P0) exterior situada entre ambos espacios, del 25 al 27 de julio.
                            </p>
                            <p class="text-white text-lg mb-4">
                                Saga-Fest Madrid aspira a convertirse en el punto de encuentro de referencia para los amantes de la cultura pop, el cómic, el cine, las series y los videojuegos en la capital.
                            </p>
                        </div>
                        <div class="md:w-1/2 w-full flex justify-center">
                            <img src="/assets/images/ifema1.png" alt="Equipo Saga-Fest Madrid" class="w-full max-w-lg h-72 object-cover rounded-2xl shadow-2xl">
                        </div>
                    </div>
                </div>

                <!-- Sección áreas del festival -->
                <div class="flex flex-col gap-10 my-16">
                    <div class="w-full">
                        <h4 class="text-2xl font-bold text-white mb-4">Áreas principales del festival:</h4>
                        <ul class="list-disc list-inside text-white text-lg mb-4">
                            <li><strong>Zona comercial:</strong> Editoriales, librerías especializadas, tiendas de cómic, merchandising, videojuegos y cine ofrecerán novedades, ediciones exclusivas y productos oficiales en la plaza central entre los pabellones.</li>
                            <li><strong>Zona de programación cultural:</strong> Entrevistas y firmas de autores, creadores y actores; talleres de ilustración, guion, cosplay y desarrollo de videojuegos; mesas redondas, proyecciones de cine y series, y emisiones en directo de pódcasts y programas de radio especializados, repartidos en diferentes escenarios y salas de los pabellones.</li>
                            <li><strong>Zona de experiencias:</strong> Espacios interactivos para probar videojuegos, realidad virtual, exposiciones temáticas y actividades para todas las edades.</li>
                            <li><strong>Zona gastronómica:</strong> Food trucks y áreas de descanso al aire libre, integradas en la plaza, para disfrutar de la oferta culinaria durante el festival.</li>
                        </ul>
                    </div>
                </div>

                <!-- Sección objetivos y retos -->
                <div class="mb-12">
                    <table class="min-w-full mb-10 rounded-lg overflow-hidden text-white text-sm border-separate border-spacing-0 table-fixed">
                        <colgroup>
                            <col style="width: 50%">
                            <col style="width: 50%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="py-3 px-6 border-b border-white/30 text-center text-2xl font-bold text-white mb-4">Objetivos</th>
                                <th class="py-3 px-6 border-b border-white/30 text-center text-2xl font-bold text-white mb-4">Retos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-white/20"> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Impulsar el sector especializado: Apoyamos a librerías, editoriales y tiendas especializadas para fortalecer su visibilidad en los ámbitos del cómic, las series, el cine y los videojuegos.</td> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Accesibilidad y diversidad: Queremos que la cultura pop sea un arte al alcance de todos, con actividades inclusivas y propuestas para todas las edades y públicos.</td> 
                            </tr> 
                            <tr class="border-b border-white/20"> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Proyección internacional: Buscamos posicionar a Madrid como un referente europeo en cómic, series, cine y videojuegos, abriendo puertas a creadores y empresas más allá de nuestras fronteras.</td> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Innovación y talento: Apostamos por nuevas tendencias y formatos narrativos en todos los medios, dando visibilidad a creadores y creadoras de todos los estilos y géneros.</td> 
                            </tr> 
                            <tr class="border-b border-white/20"> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Crear comunidad: Generamos un espacio donde creadores, fans y profesionales de cómic, series, cine y videojuegos puedan interactuar, intercambiar ideas y compartir su pasión.</td> 
                                <td class="py-3 px-6 text-center align-top text-white text-lg"> Cultura y educación: Colaboramos con instituciones y expertos para fortalecer el papel de la cultura pop en la educación y la divulgación artística.</td> 
                            </tr> 
                            <tr> 
                                <td class="py-3 px-6 text-center text-white text-lg align-top"> Promover el arte y la cultura pop: Destacamos la relevancia del cómic, las series, el cine y los videojuegos dentro del panorama cultural contemporáneo, desde superhéroes hasta anime, ciencia ficción y mucho más.</td> 
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Sección Patrocinadores -->
                <div class="mb-12">
                    <h4 class="w-full text-2xl font-bold text-white mb-4">Algunos de nuestros patrocinadores más destacados:</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div class="flex flex-col items-center">
                            <a href="https://www.primevideo.com/offers/nonprimehomepage/ref=dv_web_force_root" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/amazonprimevideo.png" alt="Amazon Prime Video" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Amazon Prime Video</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.netflix.com/es/" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/netflix.png" alt="Netflix" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Netflix</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.disneyplus.com/es-es" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/disney.png" alt="Disney" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Disney</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.max.com/es/es" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/hbomax.png" alt="HBO Max" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">HBO Max</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.sonypictures.es" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/sony.png" alt="Sony Pictures" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Sony Pictures</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.microsoft.com/es-es" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/microsoft.png" alt="Microsoft" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Microsoft</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://www.normaeditorial.com" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/normaeditorial.png" alt="Norma Editorial" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Norma Editorial</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <a href="https://distribucion.planetacomic.com" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/images/planetacomic.png" alt="Planeta Cómic" class="h-40 w-auto mx-auto rounded-xl shadow-lg border-4 border-transparent hover:border-[#1B2CC1] transition-all duration-200">
                            </a>
                            <span class="mt-2 text-white font-semibold">Planeta Cómic</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</x-app-layout>
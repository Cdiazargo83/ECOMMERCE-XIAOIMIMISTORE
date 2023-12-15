<x-app-layout>
    <section class="my-6">
        <div class="flexslider">
            <ul class="slides">
                @foreach ($banners as $banner)
                    <li>
                        <img src="{{ Storage::url($banner->image) }}" width="400" height="400" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlsContainer: $(".custom-controls-container"),
                    customDirectionNav: $(".custom-navigation a")
                });
            });
        </script>
    @endpush

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-6 py-2 bg-gray-200" id="countdown-container">
        <div class="contenedor">
            <div class="contenido">
                <div class="contador">
                    <div class="responsivo1">
                        <div class="cartel">
                            <div id="dias"></div>
                            <div class="h3">
                                <h3>Días</h3>
                            </div>
                        </div>
                        <div class="cartel">
                            <div id="horas"></div>
                            <div class="h3">
                                <h3>Horas</h3>
                            </div>
                        </div>
                    </div>
                    <div class="responsivo2">
                        <div class="cartel">
                            <div id="minutos"></div>
                            <div class="h3">
                                <h3>Minutos</h3>
                            </div>
                        </div>
                        <div class="cartel">
                            <div id="segundos"></div>
                            <div class="h3">
                                <h3>Segundos</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flexslider">
                <ul class="slides">
                    @foreach ($promocions as $promocion)
                        <li data-thumb="{{ Storage::url($promocion->image) }}">
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    controlNav: "thumbnails"
                });
            });
        </script>


        <script>
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;

            let countDown = new Date('Dic 22, 2023 18:14:00').getTime(),
                x = setInterval(function() {
                    let now = new Date().getTime(),
                        distance = countDown - now;

                    let days = Math.floor(distance / day),
                        hours = Math.floor((distance % day) / hour),
                        minutes = Math.floor((distance % hour) / minute),
                        seconds = Math.floor((distance % minute) / second);

                    document.getElementById('dias').innerText = days;
                    document.getElementById('horas').innerText = hours;

                    // Verificar si todos los valores son iguales a 0 o menores
                    if (days <= 0 && hours <= 0 && minutes <= 0 && seconds <= 0) {
                        document.getElementById('countdown-container').style.display = 'none';
                    } else {
                        document.getElementById('countdown-container').style.display = 'block';
                        document.getElementById('minutos').innerText = minutes;
                        document.getElementById('segundos').innerText = seconds;
                    }

                    // Cuando el tiempo haya terminado, puedes detener el contador
                    if (distance < 0) {
                        clearInterval(x);
                        // Puedes ocultar todos los contadores o tomar alguna otra acción aquí
                    }
                }, second)
        </script>
    </div>
    <div>
    </div>


    <section class="container bg-gray-100 my-8">

        <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">CATEGORIAS</h1>

        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    <a href="#" class="group">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg"
                                alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
                                class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Earthen Bottle</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$48</p>
                    </a>
                    <a href="#" class="group">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg"
                                alt="Olive drab green insulated bottle with flared screw lid and flat top."
                                class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Nomad Tumbler</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
                    </a>
                    <a href="#" class="group">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg"
                                alt="Person using a pen to cross a task off a productivity paper card."
                                class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Focus Paper Refill</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$89</p>
                    </a>
                    <a href="#" class="group">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            <img src="https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg"
                                alt="Hand holding black machined steel mechanical pencil with brass tip and top."
                                class="h-full w-full object-cover object-center group-hover:opacity-75">
                        </div>
                        <h3 class="mt-4 text-sm text-gray-700">Machined Mechanical Pencil</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">$35</p>
                    </a>

                    <!-- More products... -->
                </div>
            </div>
        </div>



    </section>





    <section class="container bg-gray-100 my-8">
        <h1
            class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
            PRODUCTOS DESTACADOS</h1>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @foreach ($categories as $category)
                <section class="mb-7">
                    <div class="flex items-center mb-2">
                        <h1
                            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white">
                            <mark class="px-2 text-black rounded dark:bg-orange-400">{{ $category->name }}</mark>
                        </h1>
                        <a href="{{ route('categories.show', $category) }}"
                            class="text-red-400 hover:text-red-200 hover:underline ml-2 font-semibold ">Ver mas</a>
                    </div>
                    @livewire('category-products', ['category' => $category])
                </section>
            @endforeach
        </div>
    </section>

    @push('script')
        <script>
            Livewire.on('glider', function(id) {
                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [{
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>

@livewire('footer')

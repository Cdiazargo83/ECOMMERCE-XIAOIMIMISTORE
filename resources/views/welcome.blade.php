<x-app-layout>
    <section class="my-6">

        <div class="flexslider">
            <ul class="slides">
              @foreach ($banners as $banner)
              <li>
                  <img src="{{ Storage::url($banner->image) }}" width="400" height="400"/>
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

    <div class=" max-w-4xl mx-auto px-4 sm:px-6 lg:px-6 py-2 bg-gray-200 hidden">

    <div class="contenedor">
        <div class="contenido">
          <div class="contador">
            <div class="responsivo1">
              <div class="cartel">
              <div id="dias"></div>
              <div class="h3"><h3>Días</h3></div>
            </div>
              <div class="cartel">
              <div id="horas"></div>
              <div class="h3"><h3>Horas</h3></div>
            </div>
            </div>
            <div class="responsivo2">
            <div class="cartel">
              <div id="minutos"></div>
              <div class="h3"><h3>Minutos</h3></div>
            </div>
            <div class="cartel">
              <div id="segundos"></div>
              <div class="h3"><h3>Segundos</h3></div>
            </div>
            </div>
          </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
     <div class="flexslider">
                    <ul class="slides">
                        @foreach ($promocions as $promocion)
                            <li data-thumb="{{Storage::url($promocion->image)}}">
                            </li>
                        @endforeach
                    </ul>
     </div>
    </section>
     <script >
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


        let countDown = new Date('Aug 5, 2023 24:00:00').getTime(),
            x = setInterval(function() {

             let now = new Date().getTime(),
                 distance = countDown - now;

      document.getElementById('dias').innerText = Math.floor(distance / (day)),
               document.getElementById('horas').innerText = Math.floor((distance % (day)) / (hour)),
               document.getElementById('minutos').innerText = Math.floor((distance % (hour)) / (minute)),
               document.getElementById('segundos').innerText = Math.floor((distance % (minute)) / second);
            }, second)
    </script>
    </div>

    <div>
    </div>



    <section class="container bg-gray-300 my-8">
        <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">PRODUCTOS DESTACADOS</h1>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

   @foreach ($categories as $category )

   <section class="mb-7">
        <div class="flex items-center mb-2">

            <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white"><mark class="px-2 text-black rounded dark:bg-orange-400">{{$category->name}}</mark></h1>

            <a href="{{route('categories.show', $category)}}" class="text-red-400 hover:text-red-200 hover:underline ml-2 font-semibold ">Ver mas</a>
        </div>
        @livewire('category-products', ['category'=> $category])
        </section>
        @endforeach
        </div>
    </section>
    @push('script')
        <script>

        Livewire.on('glider', function(id){

        new Glider(document.querySelector('.glider-' + id), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: '.glider-' + id + '~ .dots',
            arrows: {
                prev: '.glider-' + id + '~ .glider-prev',
                next: '.glider-' + id + '~ .glider-next'
            },

            responsive:[
                {
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



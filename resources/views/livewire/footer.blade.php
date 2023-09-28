<footer class="bg-white py-8 overflow-y-auto">
    <div class="container mx-auto px-4 md:px-0">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Sección 1 -->
            <div class="text-center md:text-left">
                <img class="mx-auto mb-2" src="{{ asset('img/central.png') }}" alt="Central Teléfonica" width="80">
                <p class="text-gray-800 text-base font-semibold">Central Teléfonica</p>
                <div class="mt-2 text-gray-600">+51 983815823</div>
                <div class="text-red-500 mt-2 py-8">Libro de reclamaciones <a href="https://snap-electronics.com/libro-de-reclamaciones/"><img src="{{ asset('img/libro.png') }}" width="100" class="mx-auto"></a></div>
            </div>

            <!-- Sección 2 -->
            <div class="text-center md:text-left">
                <img class="mx-auto mb-2" src="{{ asset('img/whats.png') }}" alt="Ventas por Whatsapp" width="80">
                <p class="text-gray-800 text-base font-semibold">Ventas por Whatsapp</p>
                <div class="mt-2"><a class="text-red-500" href="https://api.whatsapp.com/send?phone=51958970964">+51 958970964</a></div>
            </div>

            <!-- Sección 3 -->
            <div class="text-center md:text-left">
                <img class="mx-auto mb-2" src="{{ asset('img/mail.png') }}" alt="Ventas Online" width="80">
                <p class="text-gray-800 text-base font-semibold">Ventas Online</p>
                <div class="mt-2 text-red-500">comercial.peru@snap-electronics.com</div>
            </div>

            <!-- Sección 4 -->
            <div class="text-center md:text-left">
                <img class="mx-auto mb-2" src="{{ asset('img/tienda.png') }}" alt="Nuestras Tiendas" width="80">
                <p class="text-gray-800 text-base font-semibold">Nuestras Tiendas</p>
                <div class="mt-2 text-red-500">DIRECCION TIENDA1</div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Sección 5 -->
            <div class="text-center md:text-left">
                @livewire('wsp')
            </div>

            <!-- Sección 6 -->
            <div class="text-center">
                <p class="text-gray-800 text-base">&copy; Soluciones & Comunicaciones |Todos los derechos reservados {{ date('Y') }}</p>
            </div>

            <!-- Sección 7 -->

            <div class="text-center">
                <img class="mx-auto" src="{{ asset('img/pagos_footer.png') }}" alt="Accepted Payment Methods" width="300">
            </div>
        </div>
    </div>
</footer>

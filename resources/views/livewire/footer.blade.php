<footer class="bg-orange-400 py-8 overflow-y-auto">
    <div class="container mx-auto px-4 md:px-0">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="text-center">
                <img class="mx-auto mb-2" src="{{ asset('img/central.png') }}" alt="Central Teléfonica" width="80">
                <p class="text-white text-base font-semibold">Central Teléfonica</p>

                <div class="mt-2 text-white">+51 983815823</div>
                <div class="text-red-200 text-lx py-8">Libro de reclamaciones <a href="https://snap-electronics.com/libro-de-reclamaciones/"><img src="{{ asset('img/libro.png') }}" width="100" class="mx-auto"></a></div>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-2" src="{{ asset('img/whats.png') }}" alt="Ventas por Whatsapp" width="80">
                <p class="text-white text-base font-semibold">Ventas por Whatsapp</p>
                <div class="mt-2"><a class="text-red-200" href="https://api.whatsapp.com/send?phone=51958970964">+51 958970964</a></div>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-2" src="{{ asset('img/mail.png') }}" alt="Ventas Online" width="80">
                <p class="text-white text-base font-semibold">Ventas Online</p>
                <div class="mt-2 text-red-200">comercial.peru@snap-electronics.com</div>
            </div>
            <div class="text-center">
                <img class="mx-auto mb-2" src="{{ asset('img/tienda.png') }}" alt="Nuestras Tiendas" width="80">
                <p class="text-white text-base font-semibold">Nuestras Tiendas</p>
                <div class="mt-2 text-red-200">DIRECCION TIENDA1</div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="text-center">
                @livewire('wsp')
            </div>
            <div class="text-center">
                <img class="mx-auto" src="{{ asset('img/pagos_footer.png') }}" alt="Accepted Payment Methods" width="300">
            </div>
            <div class="text-center">
                <p class="text-white text-base">&copy; Soluciones & Comunicaciones | All rights reserved {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

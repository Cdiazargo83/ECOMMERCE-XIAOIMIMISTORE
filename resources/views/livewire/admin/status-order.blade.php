<div>
    <div  class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 ">
            <p class="text-gray-700 uppercase"> <span class="font-semibold">Numero de orden :</span>
            Orden - 000{{$order->id}}</p>

            <div class="bg-white rounded-lg shadow-lg px-6 py-8 mb-6 flex items-center">
                <div class="relative">
                    <div class="{{($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : ' bg-gray-400 '}} rounded-full h-12 w-12 flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>

                    <div class="absolute -left-1.5 mt-0.5">
                        <p>Pagado</p>
                    </div>
                </div>

                <div class="h-1 flex-1 {{($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : ' bg-gray-400 '}} mx-2"></div>

                <div class="relative">
                    <div class="rounded-full h-12 w-12 {{($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : ' bg-gray-400 '}} flex items-center justify-center">
                        <i class="fas fa-truck text-white"></i>
                    </div>
                    <div class="absolute -left-3.5 mt-0.5">
                        <p>Despachado</p>
                    </div>
                </div>

                <div class="h-1 flex-1 {{($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : ' bg-gray-400 '}} mx-2"></div>

                <div class="relative">
                    <div class="rounded-full h-12 w-12 {{($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : ' bg-gray-400 '}} flex items-center justify-center">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div class="absolute -left-3.5 mt-0.5">
                        <p>Entregado</p>
                    </div>
                </div>

            </div>

            <div class="mb-4" wire:ignore >
                <form   action="{{route('admin.orders.files', $order)}}"
                        method="POST"
                        class="dropzone"
                        id="my-awesome-dropzone">
                </form>

                @if ($order->images->count())
                    <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                    <h1 class="text-2xl text-center font-semibold mb-2">Evidencia de Entrega</h1>

                    <ul class="flex flex-wrap">
                    @foreach ($order->images as $image)

                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">

                        </li>

                    @endforeach
                        </ul>
                    </section>

                @endif

            </div>

            <div class="bg-gray-200 rounded-lg shadow-lg p-2 mb-6">
                <form wire:submit.prevent="update">
                    <div class="flex space-x-3 mt-4">
                        <x-jet-label>
                            PAGADO
                            <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                        </x-jet-label>

                        <x-jet-label>
                            DESPACHADO
                            <input wire:model="status" type="radio" name="status" value="3" class="mr-2">

                        </x-jet-label>
                        <x-jet-label>
                            ENTREGADO
                            <input wire:model="status" type="radio" name="status" value="4" class="mr-2">
                        </x-jet-label>

                        <x-jet-label>
                            ANULADO
                            <input wire:model="status" type="radio" name="status" value="5" class="mr-2">
                        </x-jet-label>

                    </div>
            </div>

                    <div class="bg-gray-200 rounded-lg shadow-lg p-6 mb-6">

                        <div class="my-4">
                            <x-jet-label value="Courrier" />
                            <x-jet-input type="text" class="w-full"
                                        wire:model="courrier"
                                        placeholder="Colocar Courrier"/>
                                        <x-jet-input-error for="courrier" />
                        </div>

                        <div class="my-4">
                            <x-jet-label value="Traking Number" />
                            <x-jet-input type="text" class="w-full"
                                        wire:model="tracking_number"
                                        placeholder="Tracking Number"/>
                                        <x-jet-input-error for="tracking_number" />

                        </div>

                        <div class="my-4">
                            <x-jet-label value="Guia de Remision" />
                            <x-jet-input type="text" class="w-full"
                                        wire:model="guia_remision"
                                        placeholder="Colocar la Guia de Remision"/>
                                        <x-jet-input-error for="guia_remision" />

                        </div>

                        <div class="grid grid-cols-4 gap-6 text-gray-700">

                                <div class="my-4">
                                    <x-jet-label value="Alto del Paquete" />
                                    <x-jet-input type="text" class="w-20"
                                                wire:model="alto_paquete"
                                                placeholder=""/>
                                                <x-jet-input-error for="alto_paquete" />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Ancho del Paquete" />
                                    <x-jet-input type="text" class="w-20"
                                                wire:model="ancho_paquete"
                                                placeholder=""/>
                                                <x-jet-input-error for="ancho_paquete" />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Largo del Paquete" />
                                    <x-jet-input type="text" class="w-20"
                                                wire:model="largo_paquete"
                                                placeholder=""/>
                                                <x-jet-input-error for="largo_paquete" />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Peso del Paquete" />
                                    <x-jet-input type="text" class="w-20"
                                                wire:model="peso_paquete"
                                                placeholder=""/>
                                                <x-jet-input-error for="peso_paquete" />
                                </div>
                        </div>
                        <div class="my-4">
                            <x-jet-label value="Observacion(Cantidad de paquetes)" />
                            <x-jet-input type="text" class="w-full"
                                        wire:model="observacion"
                                        placeholder=""/>
                                        <x-jet-input-error for="observacion" />
                        </div>


                    </div>

                    <div class="flex mt-2">

                        <x-jet-action-message class="mr-3 text-green-700" on="saved">
                            Pedido actualizado Correctamente
                        </x-jet-action-message>

                        <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="editImage, update">
                            Actualizar
                        </x-jet-button>

                    </div>

                </form>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg font-bold uppercase">Envio</p>
                        @if ($order->envio_type == 1)
                            <p  class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p  class="text-sm">Calle falsa</p>

                        @else
                            <p  class="text-sm">Los productos seran enviados a: </p>
                            <p  class="text-sm">{{$order->address}}</p>
                            <p>{{$order->department->name}} - {{$order->city->name}} - {{$order->district->name}}</p>
                            <p  class="text-sm ">Ubigeo: {{$order->district_id}}</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-lg  font-bold uppercase">Datos de Contacto</p>
                        <p class="text-sm">Persona que recibira el pedido: {{$order->contact}}</p>
                        <p class="text-sm">Telefono de contacto: {{$order->phone}}</p>
                        <p class="text-sm">Documento de identidad: {{$order->dni}}</p>
                    </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-lg font-bold mb-4">Resumen</p>

            <table class="table-auto w-full mb-6">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                       @foreach ($items as $item )
                    <tr>
                        <td>
                            <div class="flex">
                                <img class=" h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                                <article>
                                    <h1 class="font-bold">{{$item->name}}</h1>
                                    <div class="flex text-xs">
                                            @isset ($item->options->color)
                                               Color: {{__($item->options->color)}}
                                            @endisset

                                            @isset ($item->options->size)
                                               Color: {{__($item->options->size)}}
                                            @endisset

                                    </div>
                                </article>
                            </div>
                        </td>
                        <td class="text-center">
                               S/ {{$item->price}}
                        </td>
                        <td class="text-center">
                                {{$item->qty}}
                        </td>
                        <td class="text-center">
                            S/ {{$item->price * $item->qty}}
                        </td>
                    </tr>

                       @endforeach
                </tbody>
            </table>
                         <div class="text-right">
                            <p class="flex">Envio</p>
                            <p class="text-red-700">{{$order->shipping_cost}}</p>
                         </div>
                         <div class="text-right">
                            <p class="flex">Total</p>
                            <p class="text-red-700">S/ {{$order->total}}</p>
                         </div>
        </div>

    </div>


    @push('script')
    <script>

        Dropzone.options.myAwesomeDropzone = {
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: "Adjuntar Fotos de Entrega del Pedido",
            acceptedFiles: 'image/*',
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("naha, you don't.");
                } else {
                    done();
                }
            }
        };

    </script>
    @endpush
</div>

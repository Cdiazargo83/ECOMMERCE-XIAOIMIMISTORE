<x-app-layout>
    <div  class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

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

<div>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center">

            <p class="text-gray-700 uppercase"> <span class="font-semibold">Numero de orden :</span>
            Orden - 000{{$order->id}}</p>

            @if ($order->status==1)

            <x-button-enlace class=" ml-auto" href="{{route('order.payment', $order)}}">
                Ir a Pagar
            </x-button-enlace>

            @endif

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <p class="text-lg fond-semibold uppercase">Envio</p>
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
                        <p class="text-lg fond-semibold uppercase">Datos de Contacto</p>
                        <p class="text-sm">Persona que recibira el pedido: {{$order->contact}}</p>
                        <p class="text-sm">Telefono de contacto: {{$order->phone}}</p>
                    </div>

            </div>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-lg font-semibold mb-4">Resumen</p>

            <table class="table-auto w-full">
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
            <br>
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

</x-app-layout>
@livewire('footer')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PEDIDO N° 000{{$order->id}}</title>

    <style>
        .table {
                width: 100%;
                border: 2px solid #161510;
            }
    </style>
    <style>
        .centrado{
                text-align:center; padding:8px;
            }
    </style>

</head>
<body>
    <div  class="table max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
<div>
        </div>
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 items-center table">
            <h1 class="text-gray-700 uppercase centrado text-5xl font-extrabold">PEDIDO N° 000{{$order->id}}</h1>
            <p class=" centrado">Fecha de Emicion: {{$order->created_at}}</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 table">
            <h2 class="text-gray-700 content-center">PERSONA AUTORIZADA PARA LA RECEPCION:</h2>

            <div class="grid grid-cols-2 gap-4 text-gray-800">
                    <div>
                        <h2 class="text-lg fond-semibold uppercase font-semibold">Envio</h2>
                        @if ($order->envio_type == 1)
                            <p  class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p  class="text-sm">Calle falsa</p>
                        @else
                            <p  class="text-sm font-semibold">Los productos seran enviados a: </p>
                            <p  class="text-sm">{{$order->address}}</p>
                            <p>{{$order->department->name}} - {{$order->city->name}} - {{$order->district->name}}</p>
                            <p  class="text-sm ">Ubigeo: {{$order->district_id}}</p>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-lg fond-bold uppercase ">Datos de Contacto</h2>
                        <p class="text-sm">Persona que recibira el pedido: {{$order->contact}}</p>
                        <p class="text-sm">Telefono de contacto: {{$order->phone}}</p>
                        <p class="text-sm">Documento de Identidad: {{$order->dni}}</p>
                    </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6 table">
            <h2 class="text-lg font-semibold mb-4 centrado">DETALLES DEL PEDIDO</h2>

            <table class="table">
                <thead>
                    <tr>

                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 centrado">
                       @foreach ($items as $item )
                    <tr>
                        <td>
                            <div class="flex">
                                <article>

                                    <div class="flex text-xs">{{$item->name}}</div>

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

            <table class="centrado">
                <thead>
                        <th>Envio</th>
                        <th>Total</th>
                </thead>

                <tbody>
                    <tr>
                        <td>{{$order->shipping_cost}}</td>
                        <td>S/ {{$order->total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>

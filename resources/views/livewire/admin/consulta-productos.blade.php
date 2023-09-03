@extends('layouts.flex')

@section('content')
<div class="container">
    <h1>Consulta de Productos</h1>

    <form method="post" action="{{ route('livewire.admin.consulta-productos') }}">
        @csrf
        <div class="form-group">
            <label for="empresa">Empresa:</label>
            <input type="text" name="empresa" id="empresa" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="bodega">Bodega:</label>
            <input type="text" name="bodega" id="bodega" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Consultar</button>
    </form>

    @if ($responseData)
    <h2>Productos Consultados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($responseData->Producto as $product)
                @if ($product->Bodega->Cantidad > 0)
                    <tr>
                        <td>{{ $product->CodProducto }}</td>
                        <td>{{ $product->Descripcion }}</td>
                        <td>{{ intval($product->Bodega->Cantidad) }}</td>
                        <td>{{ $product->Precio }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@else
    <p>No se encontraron productos consultados.</p>
@endif
</div>
@endsection


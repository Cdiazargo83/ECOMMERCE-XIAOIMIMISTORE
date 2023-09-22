@extends('layouts.flex')

@section('content')
<div class="container">
    <h1>Consulta de Precio</h1>

    <form method="POST" action="{{ route('livewire.admin.consulta-precio') }}">
        @csrf
        <div class="form-group">
            <label for="empresa">Id Empresa:</label>
            <input type="text" name="empresa" class="form-control" value="{{ old('empresa') }}" required>
        </div>
        <div class="form-group">
            <label for="listaprecio">ID Lista de Precios:</label>
            <input type="text" name="listaprecio" class="form-control" value="{{ old('listaprecio') }}">
        </div>

        <button type="submit" class="btn btn-primary">Consultar</button>
    </form>

    @if(isset($responseData))
        <h2>Respuesta del Servicio Web:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Código de Producto</th>
                    <th>Descripcion</th>
                    <th>Precio de Lista</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responseData->PRODUCTO as $producto)
                <tr>
                    <td>{{ $producto->PRODUCTO }}</td>
                    <td>{{ $producto->GLOSA }}</td>
                    <td>{{ number_format(floatval($producto->PRECIOLISTA), 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection



@extends('layouts.flex')

@section('content')
    <div class="container">
        <h1>Consulta de Precios por Bodega y ID</h1>

        <form action="{{ route('livewire.admin.consulta-precio') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" value="{{ old('empresa') }}">
            </div>

            <div class="mb-3">
                <label for="id_lista_precios" class="form-label">ID Lista Precios</label>
                <input type="text" class="form-control" id="id_lista_precios" name="id_lista_precios" value="{{ old('id_lista_precios') }}">
            </div>



            <button type="submit" class="btn btn-primary">Consultar</button>
        </form>

        @if ($responseData && $responseData->TIPO !== "ERROR")
            <h2>Resultados de la Consulta:</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Código de Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responseData->Precio as $precioData)
                    <tr>
                        <td>{{ $precioData->CodProducto }}</td>
                        <td>{{ $precioData->Descripcion }}</td>
                        <td>{{ $precioData->Precio }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        @elseif ($responseData && $responseData->TIPO === "ERROR")
            <div class="alert alert-danger">
                {{ $responseData->DESCRIPCION }}
            </div>
        @endif

        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif
    </div>
@endsection





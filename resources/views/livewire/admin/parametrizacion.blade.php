<div>
   <!-- resources/views/livewire/admin/parametrizacion.blade.php -->

<div>
    <form wire:submit.prevent="guardar">
        <div>
            <label for="canal">Canal:</label>
            <input type="text" wire:model="canal" required>
        </div>
        <div>
            <label for="desc_canal">Descripción del Canal:</label>
            <input type="text" wire:model="desc_canal" required>
        </div>
        <!-- ... otros campos de formulario ... -->

        <button type="submit">Guardar</button>
    </form>

    <h2>Lista de Parametrizados:</h2>
    <table>
        <thead>
            <tr>
                <th>Canal</th>
                <th>Descripción del Canal</th>
                <th>Subcanal</th>
                <th>Descripción del Subcanal</th>
                <th>Modelo de Negocio</th>
                <th>Bodega</th>
                <!-- ... otros encabezados ... -->
            </tr>
        </thead>
        <tbody>
            @foreach ($parametrizados as $parametrizado)
                <tr>
                    <td>{{ $parametrizado->canal }}</td>
                    <td>{{ $parametrizado->desc_canal }}</td>
                    <td>{{ $parametrizado->subcanal }}</td>
                    <td>{{ $parametrizado->desc_subcanal }}</td>
                    <td>{{ $parametrizado->modelo_negocio }}</td>
                    <td>{{ $parametrizado->bodega }}</td>
                    <!-- ... otras celdas ... -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>

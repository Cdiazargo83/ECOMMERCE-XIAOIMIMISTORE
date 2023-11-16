<!-- resources/views/livewire/canal-subcanal.blade.php -->

<div>
    <form wire:submit.prevent="guardar">
        <label for="canal">Canal:</label>
        <input wire:model="canal" type="text" id="canal" name="canal" required>

        <label for="desc_canal">Descripción del Canal:</label>
        <input wire:model="desc_canal" type="text" id="desc_canal" name="desc_canal" required>

        <label for="subcanal">Subcanal:</label>
        <input wire:model="subcanal" type="text" id="subcanal" name="subcanal" required>

        <label for="desc_subcanal">Descripción del Subcanal:</label>
        <input wire:model="desc_subcanal" type="text" id="desc_subcanal" name="desc_subcanal" required>

        <label for="modelo_negocio">Modelo de Negocio:</label>
        <input wire:model="modelo_negocio" type="text" id="modelo_negocio" name="modelo_negocio" required>

        <label for="bodega">Bodega:</label>
        <input wire:model="bodega" type="text" id="bodega" name="bodega" required>

        <label for="tipo_distribucion">Tipo de Distribución:</label>
        <input wire:model="tipo_distribucion" type="text" id="tipo_distribucion" name="tipo_distribucion" required>

        <label for="lp_visual">LP Visual:</label>
        <input wire:model="lp_visual" type="text" id="lp_visual" name="lp_visual" required>

        <label for="desc_lp_visual">Descripción LP Visual:</label>
        <input wire:model="desc_lp_visual" type="text" id="desc_lp_visual" name="desc_lp_visual" required>

        <label for="lp_neto">LP Neto:</label>
        <input wire:model="lp_neto" type="text" id="lp_neto" name="lp_neto" required>

        <label for="desc_lp_neto">Descripción LP Neto:</label>
        <input wire:model="desc_lp_neto" type="text" id="desc_lp_neto" name="desc_lp_neto" required>

        <button type="submit">Guardar</button>
    </form>

    <h2>Lista de Canales y Subcanales:</h2>
    <table>
        <thead>
            <tr>
                <th>Canal</th>
                <th>Descripción del Canal</th>
                <th>Subcanal</th>
                <th>Descripción del Subcanal</th>
                <th>Modelo de Negocio</th>
                <th>Bodega</th>
                <th>Tipo de Distribución</th>
                <th>LP Visual</th>
                <th>Descripción LP Visual</th>
                <th>LP Neto</th>
                <th>Descripción LP Neto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($canalSubcanales as $canalSubcanal)
                <tr>
                    <td>{{ $canalSubcanal->canal }}</td>
                    <td>{{ $canalSubcanal->desc_canal }}</td>
                    <td>{{ $canalSubcanal->subcanal }}</td>
                    <td>{{ $canalSubcanal->desc_subcanal }}</td>
                    <td>{{ $canalSubcanal->modelo_negocio }}</td>
                    <td>{{ $canalSubcanal->bodega }}</td>
                    <td>{{ $canalSubcanal->tipo_distribucion }}</td>
                    <td>{{ $canalSubcanal->lp_visual }}</td>
                    <td>{{ $canalSubcanal->desc_lp_visual }}</td>
                    <td>{{ $canalSubcanal->lp_neto }}</td>
                    <td>{{ $canalSubcanal->desc_lp_neto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

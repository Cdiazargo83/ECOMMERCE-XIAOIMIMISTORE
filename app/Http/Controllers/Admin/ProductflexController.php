<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use SoapClient;
use Illuminate\Support\Facades\Log;

class ProductflexController extends Controller
{
    public function consultaProductos(Request $request)
    {
        try {
            // URL del WSDL del servicio web SOAP
            $wsdlUrl = "https://ws-erp.manager.cl/Flexline/Saco/Ws%20ConsultaStock/ConsultaStock.asmx?WSDL";

            // Parámetros para la llamada SOAP
            $empresaParameter = $request->input('empresa');
            $bodegaParameter = $request->input('bodega');

            // Crear un cliente SOAP
            $soapClient = new SoapClient($wsdlUrl, [
                'trace' => true,
                'exceptions' => true,
            ]);

            // Realizar la llamada SOAP al método "ConsultaStock_BodegaLPrecios"
            $response = $soapClient->ConsultaStock_BodegaLPrecios([
                '__Empresa' => $empresaParameter,
                '__Bodega' => $bodegaParameter,
            ]);

            // Obtener y procesar la respuesta en formato XML
            $xmlResponse = $response->ConsultaStock_BodegaLPreciosResult;
            $responseData = simplexml_load_string($xmlResponse);

            // Verificar si se obtuvo una respuesta válida
            if (!$responseData || empty($responseData->Producto)) {
                return view('livewire.admin.consulta-productos', [
                    'responseData' => null,
                    'empresa' => $empresaParameter,
                    'bodega' => $bodegaParameter,
                ]);
            }

            // Iterar sobre los productos y guardarlos en la base de datos
            foreach ($responseData->Producto as $productData) {
                $sku = (string)$productData->CodProducto;

                // Validar los datos antes de guardarlos
                if ($this->validateProductData($productData)) {
                    $existingProduct = Product::firstOrNew(['sku' => $sku]);

                    $existingProduct->nombre = (string)$productData->Descripcion;
                    $existingProduct->quantity = intval($productData->Bodega->Cantidad);
                    // Agrega otros campos según sea necesario

                    $existingProduct->save();
                }
            }

            // Puedes mostrar la respuesta en la vista o realizar otras acciones según tus necesidades
            return view('livewire.admin.consulta-productos', [
                'responseData' => $responseData,
                'empresa' => $empresaParameter,
                'bodega' => $bodegaParameter,
            ]);
        } catch (\Exception $e) {
            // Registrar el error en los registros de la aplicación
            Log::error('Error al consultar y guardar productos: ' . $e->getMessage());

            // En caso de error, puedes manejarlo o mostrar una vista de error
            return view('livewire.error', ['error' => $e->getMessage()]);
        }
    }

    private function validateProductData($productData)
    {
        // Agrega lógica de validación personalizada aquí si es necesario
        // Por ejemplo, verifica que los campos requeridos estén presentes y tengan valores válidos
        // Retorna true si los datos son válidos, false en caso contrario
        return true;
    }
}

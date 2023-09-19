<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SoapClient;
use App\Models\Product;

class ProductflexController extends Controller
{

    public function consultaProductos(Request $request)
    {
        try {
            // URL del WSDL del servicio web SOAP
            $wsdlUrl = "https://ws-erp.manager.cl/Flexline/Saco/Ws%20ConsultaStock/ConsultaStock.asmx?WSDL";

            // Crear un cliente SOAP
            $soapClient = new \SoapClient($wsdlUrl, [
                'trace' => true,       // Habilitar el seguimiento de llamadas SOAP
                'exceptions' => true,  // Habilitar excepciones en caso de errores
            ]);

            // Parámetros para la llamada SOAP
            $empresaParameter = $request->input('empresa');
            $bodegaParameter = $request->input('bodega');

            // Realizar la llamada SOAP al método "ConsultaStock_BodegaLPrecios"
            $response = $soapClient->ConsultaStock_BodegaLPrecios([
                '__Empresa' => $empresaParameter,
                '__Bodega' => $bodegaParameter,
            ]);


            // Obtener y procesar la respuesta en formato XML
            $xmlResponse = $response->ConsultaStock_BodegaLPreciosResult;
        $responseData = simplexml_load_string($xmlResponse);

    foreach ($responseData->Producto as $productData) {
        $sku = (string) $productData->CodProducto;
        $existingProduct = Product::where('sku', $sku)->first();

        if ($existingProduct) {
            // Actualizar los campos del producto existente
            $existingProduct->update([
                'name' => (string) $productData->Descripcion,
                'quantity' => intval($productData->Bodega->Cantidad),
                'price' => (float) $productData->Precio,
                'description' => (string) $productData->Descripcion,
                'price_tachado' => (float) $productData->Precio,
                'price_partner' => (float) $productData->Precio,
                'subcategory_id' => 3,
                'brand_id' => 1,
                'slug' => (string) $productData->Descripcion,
                'stock_flex'=> intval($productData->Bodega->Cantidad),
                // Actualiza otros campos según sea necesario
            ]);

        } else {
            // El producto no existe, crea uno nuevo
            Product::create([
                'sku' => $sku,
                'name' => (string) $productData->Descripcion,
                'quantity' => intval($productData->Bodega->Cantidad),
                'price' => (float) $productData->Precio,
                'description' => (string) $productData->Descripcion,
                'price_tachado' => (float) $productData->Precio,
                'price_partner' => (float) $productData->Precio,
                'subcategory_id' => 3,
                'brand_id' => 1,
                'slug' => (string) $productData->Descripcion,
                'stock_flex'=> intval($productData->Bodega->Cantidad),
                // Agrega otros campos según sea necesario
            ]);
        }
    }



           // dd($xmlResponse);

            // Devolver la vista con los datos obtenidos del servicio web
            return view('livewire.admin.consulta-productos', ['responseData' => $responseData]);

        } catch (\Exception $e) {
            dd($e->getMessage()); // Imprimir el mensaje de excepción
            // En caso de error, mostrar una vista de error con el mensaje de excepción
            return view('livewire.error', ['error' => $e->getMessage()]);
        }

        }
    }





<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SoapClient;
use App\Models\Product;
use App\Models\Image;
use Faker\Factory as Faker;

class ProductflexController extends Controller
{
    public function consultaProductos(Request $request)
    {
        try {
            // URL del WSDL del servicio web SOAP
            $wsdlUrl = "https://ws-erp.manager.cl/Flexline/Saco/Ws%20ConsultaStock/ConsultaStock.asmx?WSDL";

            // Crear un cliente SOAP
            $soapClient = new \SoapClient($wsdlUrl, [
                'trace' => true,
                'exceptions' => true,
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

            // Crear una instancia de Faker
            $faker = Faker::create();

            foreach ($responseData->Producto as $productData) {
                $sku = (string) $productData->CodProducto;
                $existingProduct = Product::where('sku', $sku)->first();

                // Crear un arreglo con los datos que deseas almacenar en 'bodega'
                $bodegaData = [
                    '03-LIM-ATOCONG-MISTR' => (string) $productData->Bodega->Cantidad,
                    '03-LIM-JOCKEYPZ-MIST' => (string) $productData->Bodega->Cantidad,
                    '03-LIM-MEGAPLZ-MISTR' => (string) $productData->Bodega->Cantidad,
                    '03-LIM-HUAYLAS-MISTR' => (string) $productData->Bodega->Cantidad,
                    '03-LIM-PURUCHU-MISTR' => (string) $productData->Bodega->Cantidad,

                    // Agrega más campos según sea necesario
                ];

                // Convertir el arreglo a formato JSON
                $bodegaDataJSON = json_encode($bodegaData);

                if ($existingProduct) {
                    // Actualizar los campos del producto existente
                    $existingProduct->update([
                        'name' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),
                        'description' => (string) $productData->Descripcion,
                        'bodega' => $bodegaDataJSON, // Asignar el valor JSON
                        // Actualiza otros campos según sea necesario
                    ]);
                } else {
                    // El producto no existe, crea uno nuevo
                    $newProduct = Product::create([
                        'sku' => $sku,
                        'name' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),
                        'description' => (string) $productData->Descripcion,
                        'bodega' => $bodegaDataJSON, // Asignar el valor JSON
                        'subcategory_id' => 3,
                        'brand_id' => 3,
                        'slug' => (string) $productData->Descripcion,
                        'stock_flex' => intval($productData->Bodega->Cantidad),
                        'price' => 0,
                        'price_tachado' => 0,
                        'price_partner' => 0,
                        'quantity_partner' => 0,
                        // Agrega otros campos según sea necesario
                    ]);

                    // Agregar lógica para asociar una imagen con datos falsos a los productos aquí
                    $this->associateImageWithFakerData($newProduct, $faker);
                }
            }

            // Devolver la vista con los datos obtenidos del servicio web
            return view('livewire.admin.consulta-productos', ['responseData' => $responseData]);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return view('livewire.error', ['error' => $e->getMessage()]);
        }
    }

    // Función para asociar una imagen con datos predeterminados a un producto
    private function associateImageWithFakerData($product, $faker)
    {
        // Establecer un valor predeterminado para el campo 'url'
        $defaultImageUrl = 'default_image_url.jpg';

        // Crear un registro de imagen asociado al producto con el valor predeterminado
        $image = new Image([
            'url' => $defaultImageUrl,
            'imageable_id' => $product->id,
            'imageable_type' => Product::class,
        ]);

        $image->save();
    }
}

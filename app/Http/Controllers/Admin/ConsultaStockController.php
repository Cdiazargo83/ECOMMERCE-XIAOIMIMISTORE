<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SoapClient;
use App\Models\Product;
use App\Models\Image;
use App\Models\ProductSaco;
use Faker\Factory as Faker;

class ConsultaStockController extends Controller
{
    public function consultaStock(Request $request)
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

            $faker = Faker::create();

            foreach ($responseData->Producto as $productData) {
                $sku = (string) $productData->CodProducto;
                $existingProduct = ProductSaco::where('sku', $sku)->first();

                if ($existingProduct) {
                    $existingProduct->update([
                        'name' => (string) $productData->Descripcion,
                        'description' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),
                    ]);

                    switch ($existingProduct->bodega) {
                        case '01-CH-BITEL':
                            $existingProduct->{'chbitel'} = intval($productData->Bodega->Cantidad);
                            break;
                    }

                    // Calcular y actualizar el campo 'stock_flex'
                    $existingProduct->quantity = $existingProduct->chbitel;

                    $existingProduct->save();
                } else {
                    // El producto no existe, crea uno nuevo
                    $newProduct = ProductSaco::create([
                        'sku' => $sku,
                        'name' => (string) $productData->Descripcion,
                        'description' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),

                        'subcategory_id' => 3,
                        'brand_id' => 3,
                        'slug' => $sku,
                        'price' => 0,
                        'chbitel' => intval($productData->Bodega->Cantidad), // Asigna la cantidad directamente
                    ]);

                    switch ($newProduct->bodega) {
                        case '01-CH-BITEL':
                            $newProduct->{'chbitel'} = intval($productData->Bodega->Cantidad);
                            break;
                        }
                        $newProduct->quantity =


                        $newProduct->chbitel;
                    $newProduct->save();


                    // Asociar una imagen con datos ficticios al nuevo producto
                    $this->associateImageWithFakerData($newProduct, $faker);
                }
            }

            // dd($responseData);

            // Devolver la vista con los datos obtenidos del servicio web
            return view('livewire.admin.consulta-stock', ['responseData' => $responseData]);
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
            'imageable_type' => ProductSaco::class,
        ]);

        $image->save();
    }
}

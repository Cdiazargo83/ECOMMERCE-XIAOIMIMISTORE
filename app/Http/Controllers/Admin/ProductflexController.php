<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

                if ($existingProduct) {
                    // Actualizar los campos del producto existente
                    $existingProduct->update([
                        'name' => (string) $productData->Descripcion,
                        'description' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),
                        'bodega' => (string) $productData->Bodega->Descripcion,
                        // Actualiza otros campos según sea necesario
                    ]);

                    // Verificar el valor de 'bodega' y asignar 'quantity' según corresponda
                    switch ($existingProduct->bodega) {
                        case '03-LIM-ATOCONG-MISTR':
                            $existingProduct->{'03-LIM-ATOCONG-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-JOCKEYPZ-MIST':
                            $existingProduct->{'03-LIM-JOCKEYPZ-MIST'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-MEGAPLZ-MISTR':
                            $existingProduct->{'03-LIM-MEGAPLZ-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-HUAYLAS-MISTR':
                            $existingProduct->{'03-LIM-HUAYLAS-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-PURUCHU-MISTR':
                            $existingProduct->{'03-LIM-PURUCHU-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                    }

                    $existingProduct->save();
                } else {
                    // El producto no existe, crea uno nuevo
                    $newProduct = Product::create([
                        'sku' => $sku,
                        'name' => (string) $productData->Descripcion,
                        'description' => (string) $productData->Descripcion,
                        'quantity' => intval($productData->Bodega->Cantidad),
                        'bodega' => (string) $productData->Bodega->Descripcion,
                        // Asigna un valor predeterminado a las columnas correspondientes
                        '03-LIM-ATOCONG-MISTR' => 0,
                        '03-LIM-JOCKEYPZ-MIST' => 0,
                        '03-LIM-MEGAPLZ-MISTR' => 0,
                        '03-LIM-HUAYLAS-MISTR' => 0,
                        '03-LIM-PURUCHU-MISTR' => 0,
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

                    // Verificar el valor de 'bodega' y asignar 'quantity' según corresponda
                    switch ($newProduct->bodega) {
                        case '03-LIM-ATOCONG-MISTR':
                            $newProduct->{'03-LIM-ATOCONG-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-JOCKEYPZ-MIST':
                            $newProduct->{'03-LIM-JOCKEYPZ-MIST'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-MEGAPLZ-MISTR':
                            $newProduct->{'03-LIM-MEGAPLZ-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-HUAYLAS-MISTR':
                            $newProduct->{'03-LIM-HUAYLAS-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                        case '03-LIM-PURUCHU-MISTR':
                            $newProduct->{'03-LIM-PURUCHU-MISTR'} = intval($productData->Bodega->Cantidad);
                            break;
                    }

                    $newProduct->save();

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

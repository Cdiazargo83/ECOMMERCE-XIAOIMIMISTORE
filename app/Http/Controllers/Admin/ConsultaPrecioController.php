<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SoapClient;
use App\Models\Product;

class ConsultaPrecioController extends Controller
{
    public function consultaPrecio(Request $request)
    {
        try {
            // Realizar la llamada SOAP y obtener la respuesta
            $responseData = $this->realizarConsultaSOAP($request->input('empresa'), $request->input('listaprecio'));

            // Guardar los datos en la base de datos
            $this->guardarDatosEnDB($responseData);

            // Registro exitoso en el archivo de registro
            Log::info('Consulta SOAP exitosa y datos guardados en la base de datos.');

            // Devolver la vista con los datos obtenidos del servicio web
            return view('livewire.admin.consulta-precio', ['responseData' => $responseData]);

        } catch (\SoapFault $soapException) {
            // Manejo de error SOAP
            dd($soapException->getMessage());

        } catch (\Exception $e) {
            // Manejo de error general
            dd($e->getMessage());
        }
    }

    private function realizarConsultaSOAP($empresa, $listaprecio)
    {
        // URL del WSDL del servicio web SOAP
        $wsdlUrl = "https://ws-erp.manager.cl/Flexline/Saco/Ws%20ConsultaProducto/WSConsultaProducto.asmx?WSDL";

        // Crear un cliente SOAP
        $soapClient = new \SoapClient($wsdlUrl, [
            'trace' => true,       // Habilitar el seguimiento de llamadas SOAP
            'exceptions' => true,  // Habilitar excepciones en caso de errores
        ]);

        // Realizar la llamada SOAP al método "ConsultaProductos"
        $response = $soapClient->ConsultaListaPrecios([
            '__Empresa' => $empresa,
            '__IdListaPrecios' => $listaprecio,
        ]);

        // Obtener y procesar la respuesta en formato XML
        $xmlResponse = $response->ConsultaListaPreciosResult;
        $responseData = simplexml_load_string($xmlResponse);

        return $responseData;
    }

    private function guardarDatosEnDB($responseData)
    {
        foreach ($responseData->PRODUCTO as $producto) {
            // Buscar el producto por SKU en la base de datos
            $sku = (string)$producto->PRODUCTO;
            $existingProduct = Product::where('sku', $sku)->first();

            if (!$existingProduct) {
                // Si el producto no existe, créalo
                Product::create([
                    'sku' => (string)$producto->PRODUCTO,
                    'name' => (string)$producto->GLOSA,
                    'quantity' => 0,
                    'description' => $producto->GLOSA,
                    'subcategory_id' => 3,
                    'brand_id' => 1,
                    'slug' => (string)$producto->GLOSA,
                    'stock_flex' => 0,
                    'price' => (float)$producto->PRECIOLISTA,
                    'price_tachado' => (float)$producto->PRECIOLISTA,
                    'price_partner' => (float)$producto->PRECIOLISTA,
                    'quantity_partner' => 0
                    // Añadir otros campos y asignar los valores correctos aquí
                ]);
            } else {
                // Si el producto ya existe, actualiza sus datos si es necesario
                $existingProduct->name = (string)$producto->GLOSA;
                $existingProduct->price = (float)$producto->PRECIOLISTA;
                $existingProduct->price_tachado = (float)$producto->PRECIOLISTA;
                $existingProduct->price_partner = (float)$producto->PRECIOLISTA;
                // Actualiza otros campos si es necesario

                $existingProduct->save(); // Guarda los cambios en la base de datos
            }
        }
    }
}

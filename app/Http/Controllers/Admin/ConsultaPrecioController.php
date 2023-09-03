<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use SoapClient;


class ConsultaPrecioController extends Controller
{
    public function consultaPrecio(Request $request)
    {
        try {
            $wsdlUrl = "https://ws-erp.manager.cl/Flexline/Saco/Ws%20ConsultaProducto/WSConsultaProducto.asmx?WSDL";

            $soapClient = new SoapClient($wsdlUrl, [
                'trace' => true,
                'exceptions' => true,
            ]);

            // Obtener los valores de los campos del formulario
            $empresaParameter = $request->input('empresa', '003');
            $idListaPreciosParameter = $request->input('id_lista_precios', '80');
            //$nombreListaPreciosParameter = $request->input('nombre_lista_precios','LP-USUARIO FINAL-TIENDA WEB-VISUAL');

            // Realizar la llamada SOAP a un método del servicio web
            $response = $soapClient->ConsultaListaPrecios([
                '__Empresa' => $empresaParameter,
                '__IdListaPrecios' => $idListaPreciosParameter,
               // '__NombreListaPrecios'=> $nombreListaPreciosParameter,
            ]);

            // Obtener y procesar la respuesta en formato XML
            $xmlResponse = $response->ConsultaListaPreciosResult;
            $responseData = simplexml_load_string($xmlResponse);

            foreach ($responseData->Precio as $precioData) {
                Product::updateOrCreate(
                    ['sku' => $precioData->CodProducto],
                    [
                        'name' => $precioData->Descripcion,
                        'precio' => $precioData->Precio,
                        // Add other fields you want to save
                    ]
                );
            }

            return view('livewire.admin.consulta-precio', [
                'responseData' => $responseData,
                'empresa' => $empresaParameter,
                'idListaPrecios' => $idListaPreciosParameter,
              //  'nombreListaPrecios'=> $nombreListaPreciosParameter,
            ]);

        } catch (\Exception $e) {
            return view('livewire.error', ['error' => $e->getMessage()]);
        }
    }
}








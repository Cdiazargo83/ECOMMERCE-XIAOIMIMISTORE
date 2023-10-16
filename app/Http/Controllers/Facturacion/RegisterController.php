<?php

namespace App\Http\Controllers\Facturacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Procesa los datos recibidos
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
        ];

        $client = new Client();

        try {
            $response = $client->request('POST', 'http://127.0.0.1:8000/api/register', [
                'form_params' => $data
            ]);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();

            // Manejar la respuesta
            dd($content);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $content = $response->getBody()->getContents();
                dd($content);
            }
        }
    }
}

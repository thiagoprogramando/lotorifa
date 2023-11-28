<?php

namespace App\Http\Controllers\gatway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Carbon\Carbon;

class AssasController extends Controller {
    
    public function geraPix($name, $cpf, $numberTotal, $token = null) {
        $client = new Client();

        if ($token != null) {
            $options = [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'access_token' => env('API_TOKEN_ASSAS'),
                ],
                'json' => [
                    'name'      => $name,
                    'cpfCnpj'   => $cpf,
                ],
            ];
            $response = $client->post(env('API_URL_ASSAS') . '/v3/customers', $options);
            $body = (string) $response->getBody();
            $data = json_decode($body, true);

            if ($response->getStatusCode() === 200) {
                $customerId = $data['id'];
            } else {
                return false;
            }
        } else {
            $customerId = $token;
        }

        $tomorrow = Carbon::now()->addDay()->format('Y-m-d');

        $options['json'] = [
            'customer'          => $customerId,
            'billingType'       => "PIX",
            'value'             => $numberTotal * 2,
            'dueDate'           => $tomorrow,
            'description'       => 'LotoRifa - Boa sorte!',
        ];

        $response = $client->post(env('API_URL_ASSAS') . '/v3/payments', $options);
        $body = (string) $response->getBody();
        $data = json_decode($body, true);
        if ($response->getStatusCode() === 200) {

            // $dados['json'] = [
            //     'paymentId'     => $data['id'],
            //     'customer'      => $data['customer'],
            //     'paymentLink'   => $data['invoiceUrl'],
            // ];

            // return $dados;

            var_dump($data);
        } else {
            return "Erro!";
        }

    }

}

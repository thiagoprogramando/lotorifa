<?php

namespace App\Http\Controllers\gatway;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Jobs\ProcessWebhook;

use Illuminate\Http\Request;


use GuzzleHttp\Client;

class AssasController extends Controller {
    
    public function geraCobranca($name, $cpf, $numberTotal, $token = null) {
        
        $client = new Client();

        if ($token) {
            $customerId = $token;
        } else {
            $customerId = $this->createCustomer($client, $name, $cpf);
            if (!$customerId) {
                return false;
            }

            $user = User::where('cpf', $cpf)->first();
            $user->token = $customerId;
            $user->save();
        }

        $payment = $this->createPayment($client, $customerId, $numberTotal);
        if($payment) {
            return $payment;
        } else {
            return false;
        }
    }

    private function createCustomer($client, $name, $cpf) {

        $options = [
            'headers' => [
                'accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'access_token'  => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTc1MjA6OiRhYWNoX2YzNTdkZjNiLTllZDctNGQ3ZC1iMDdiLWU3Zjg4ODE3YzFjNg==',
            ],
            'json' => [
                'name'    => $name,
                'cpfCnpj' => $cpf,
            ],
            'verify' => false,
        ];

        $response = $client->post(env('API_URL_ASSAS') . 'v3/customers', $options);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);
            return $data['id'];
        } else {
            return false;
        }
    }

    private function createPayment($client, $customerId, $numberTotal) {

        $options = ['verify' => false];

        $options = [
            'headers' => [
                'accept'       => 'application/json',
                'Content-Type' => 'application/json',
                'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTc1MjA6OiRhYWNoX2YzNTdkZjNiLTllZDctNGQ3ZC1iMDdiLWU3Zjg4ODE3YzFjNg==',
            ],
            'json' => [
                'customer'    => $customerId,
                'billingType' => 'PIX',
                'value'       => $numberTotal * 2,
                'dueDate'     => now()->format('Y-m-d'),
                'description' => 'LotoRifa - Boa sorte!',
            ],
            'verify' => false,
        ];

        $response = $client->post(env('API_URL_ASSAS') . 'v3/payments', $options);

        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true);

            return [
                'token'      => $data['id'],
                'status'     => $data['status'],
                'dueDate'    => $data['dueDate'],
                'invoiceUrl' => $data['invoiceUrl'],
                'netValue'   => $data['netValue'],
            ];
        } else {
            return false;
        }
    }

    public function geraPix($token) {

        $client = new \GuzzleHttp\Client();
    
        try {
            $response = $client->request('GET', env('API_URL_ASSAS').'v3/payments/' . $token . '/pixQrCode', [
                'headers' => [
                    'accept'       => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTc1MjA6OiRhYWNoX2YzNTdkZjNiLTllZDctNGQ3ZC1iMDdiLWU3Zjg4ODE3YzFjNg==',
                ],
                'verify'  => false,
            ]);
    
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            if (isset($decodedBody['success']) && $decodedBody['success']) {
                return [
                    'encodedImage'   => $decodedBody['encodedImage'],
                    'payload'        => $decodedBody['payload'],
                    'expirationDate' => $decodedBody['expirationDate'],
                ];
            } else {
                return false;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return false;
        }
    }

    public function saque($chave, $valor, $type) {
        $client = new \GuzzleHttp\Client();
    
        try {
            $response = $client->request('POST', env('API_URL_ASSAS').'v3/transfers', [
                'headers' => [
                    'accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'access_token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwNTc1MjA6OiRhYWNoX2YzNTdkZjNiLTllZDctNGQ3ZC1iMDdiLWU3Zjg4ODE3YzFjNg==',
                ],
                'json' => [
                    'value' => $valor,
                    'operationType' => 'PIX',
                    'pixAddressKey' => $chave,
                    'pixAddressKeyType' => $type,
                    'description' => 'Saque LotoRifa LTDA',
                ],
                'verify'  => false,
            ]);
    
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            if ($decodedBody['status'] === 'PENDING') {
                return ['success' => true, 'message' => 'Saque agendado com sucesso'];
            } else {
                return ['success' => false, 'message' => 'Situação do Saque: ' . $decodedBody['status']];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response = $e->getResponse();
            $body = $response->getBody()->getContents();
            $decodedBody = json_decode($body, true);
    
            return ['success' => false, 'error' => $decodedBody['errors'][0]['description']];
        }
    }

    public function webhook(Request $request) {
        $jsonData = $request->json()->all();

        if ($jsonData['event'] === 'PAYMENT_CONFIRMED' || $jsonData['event'] === 'PAYMENT_RECEIVED') {
            ProcessWebhook::dispatch($jsonData);

            return response()->json(['status' => 'success', 'message' => 'Requisição adiciona em fila!']);
        }

        return response()->json(['status' => 'success', 'message' => 'Webhook não utilizado!']);
    }

}

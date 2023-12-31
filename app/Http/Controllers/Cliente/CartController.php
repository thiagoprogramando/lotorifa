<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\gatway\AssasController as GatwayAssasController;
use App\Models\Bet;

use Illuminate\Http\Request;

class CartController extends Controller {

    public function endcart(Request $request) {

        $user = auth()->user();

        //Validation the User
        if (!auth()->user()) {
            return response()->json(['error' => 'Faça login para finalizar o carrinho!'], 400);
        }

        //Validation the Request
        $numbers = $request->numbers;
        if (empty($numbers)) {
            return response()->json(['error' => 'Nenhum número de concursos encontrado!'], 400);
        }

        //Validation the Numbers
        $invalidNumbers = [];
        foreach ($numbers as $number) {

            $bet = Bet::find($number['numberId']);
            if (!$bet || $bet->id_user !== null || $bet->token !== null) {
                $invalidNumbers[] = $number['numberId'];
            }
        }

        if (!empty($invalidNumbers)) {
            return response()->json([
                'error' => 'Algumas das suas escolhas não estão mais disponíveis, removemos do seu carrinho!',
                'invalidNumbers' => $invalidNumbers
            ], 400);
        }

        $numberOfItems = count($numbers);

        $assasController = new GatwayAssasController();
        $token = $assasController->geraCobranca($user->name, $user->cpf, $numberOfItems, $user->token);

        //End Cart
        if($token['token']) {
            foreach ($numbers as $number) {
                Bet::where('id', $number['numberId'])->update(['id_user' => $user->id, 'netValue' => $token['netValue'], 'status' => $token['status'], 'token' => $token['token'], 'dueDate' => $token['dueDate'], 'invoiceUrl' => $token['invoiceUrl']]);
            }
        }

        //QrCode
        $qrcode = $assasController->geraPix($token['token']);
        if($qrcode) {
            return response()->json([
                'encodedImage'    => $qrcode['encodedImage'],
                'payload'         => $qrcode['payload'],
                'expirationDate'  => $qrcode['expirationDate'],
            ]);
        }
        
        return response()->json(['error' => 'Atenção', 'message' => 'Não foi possivel gerar o QR CODE, iremos te redirecionar!', 'link' => $token['invoiceUrl']]);
    }
}

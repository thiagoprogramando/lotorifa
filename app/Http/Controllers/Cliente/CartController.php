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
            if (!$bet || $bet->id_user !== null || $bet->token !== null || $bet->status !== null) {
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
        $token = $assasController->geraPix($user->name, $user->cpf, $numberOfItems, $user->token);

        var_dump($token);

        //End Cart
        // foreach ($numbers as $number) {
        //     Bet::where('id', $number['numberId'])->update(['id_user' => $user->id, 'status' => 'PENDING_PAY', 'token' => $token, ]);
        // }

        // return response()->json(['success' => 'Parabéns! Agora é só esperar o sorteio!']);
    }
}

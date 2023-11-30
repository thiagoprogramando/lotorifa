<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\User;
use Illuminate\Http\Request;

class PayController extends Controller {
    
    public function commission($token) {

        $total = Bet::where('token', $token)->sum('value');
        $bet = Bet::where('token', $token)->first('value');

        //20% de Comissão
        $commission = $total * 20 / 100;

        //Verifica INDICADOR do Usuário
        $user = User::where('id', $bet->id_user)->first();
        if($user->id_sponsor != null) {
            //Existe Patrocinador
            $influencer = User::where('id', $user->id_sponsor)->first();

            //Verifica se influencer tem Agente
            if($influencer->id_sponsor != null) {
                $commissionAgente= ($commission * 20) / 100;
                $commissionInfluencer = $commission - (($commission * 20) / 100);

                $influencer->wallet = ($influencer->wallet + $commissionInfluencer);
                $influencer->save();

                $agente = User::where('id', $influencer->id_sponsor)->first();
                $agente->wallet = ($influencer->wallet + $commissionAgente);
            }

            //Caso não tenha Agente
            $influencer->wallet = ($influencer->wallet + $commission);
            $influencer->save();

        }

        return true;
    }

}

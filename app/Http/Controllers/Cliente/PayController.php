<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\User;
use Illuminate\Http\Request;

class PayController extends Controller {
    
    public function commission($token) {

        $bet = Bet::where('token', $token)->first();
        if (!$bet) {
            return false;
        }

        $total = Bet::where('token', $token)->sum('value');
        $commission = $total * 20 / 100;

        $user = User::where('id', $bet->id_user)->first();
        if($user && $user->id_sponsor != null) {
 
            $influencer = User::where('id', $user->id_sponsor)->first();
            if($influencer->id_sponsor != null) {
                $commissionAgente= ($commission * 20) / 100;
                $commissionInfluencer = $commission - (($commission * 20) / 100);

                $influencer->wallet = ($influencer->wallet + $commissionInfluencer);
                $influencer->save();

                $agente = User::where('id', $influencer->id_sponsor)->first();
                $agente->wallet = ($influencer->wallet + $commissionAgente);
            }

            $influencer->wallet = ($influencer->wallet + $commission);
            $influencer->save();
        } else {
            return false;
        }

        return true;
    }

}

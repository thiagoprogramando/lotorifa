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
        $commission = $total * 0.20; // Comissão é 20% do total

        $user = User::where('id', $bet->id_user)->first();
        if (!$user || $user->id_sponsor === null) {
            return true;
        }

        $influencer = User::find($user->id_sponsor);
        if ($influencer && $influencer->id_sponsor === null) {

            $influencer->wallet += $commission;
            $influencer->save();
        } else {

            $commissionAgente = $commission * 0.20;
            $commissionInfluencer = $commission - $commissionAgente;

            $influencer->wallet += $commissionInfluencer;
            $influencer->save();

            $agente = User::find($influencer->id_sponsor);
            if ($agente) {
                $agente->wallet += $commissionAgente;
                $agente->save();
            }
        }

        // if($user->id_sponsor != null) {
 
        //     $influencer = User::where('id', $user->id_sponsor)->first();
        //     if($influencer->id_sponsor != null) {
        //         $commissionAgente= ($commission * 0.20) / 100;
        //         $commissionInfluencer = $commission - $commissionAgente;

        //         $influencer->wallet = ($influencer->wallet + $commissionInfluencer);
        //         $influencer->save();

        //         $agente = User::where('id', $influencer->id_sponsor)->first();
        //         $agente->wallet = ($agente->wallet + $commissionAgente);
        //     }

        //     $influencer->wallet = ($influencer->wallet + $commission);
        //     $influencer->save();
        // } else {
        //     return false;
        // }

        return true;
    }

}

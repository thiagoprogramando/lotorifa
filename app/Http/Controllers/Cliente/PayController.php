<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\gatway\AssasController as GatwayAssasController;

use App\Models\Bet;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PayController extends Controller {
    
    public function commission($token) {

        $bet = Bet::where('token', $token)->first();
        if (!$bet) {
            return false;
        }

        $total = Bet::where('token', $token)->sum('value');
        $commission = $total * 0.20;

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

        return true;
    }

    public function saque(Request $request) {

        $request->validate([
            'key_pix' => 'required',
            'password' => 'required|string',
        ]);

        $usuario = Auth::user();
        if (Hash::check($request->password, $usuario->password)) {
            
            if ($usuario->wallet > 5) {
                $saque = new GatwayAssasController();

                $key_pix = $request->key_pix != 'EMAIL' ? str_replace(['.', '-', '_', ','], '', $request->key_pix) : $request->key_pix;
                $realizaSaque = $saque->saque($key_pix, $usuario->wallet, $request->type);
            
                if ($realizaSaque['success']) {
                    return redirect()->back()->with('success', $realizaSaque['message']);
                }
            
                return redirect()->back()->with('error', 'Tivemos um problema ao realizar o saque: ' . $realizaSaque['error']);
            }

            return redirect()->back()->with('error', 'Seu saldo está abaixo do valor mínimo: R$ 5.00');
        } else {
            return redirect()->back()->with('error', 'Verifique sua senha!');
        }
    }

}

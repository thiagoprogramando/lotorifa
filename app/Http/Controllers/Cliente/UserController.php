<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Extract;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    public function login(Request $request) {

        $credentials = $request->only(['email', 'password']);
        $credentials['password'] = $credentials['password'];
        if (Auth::attempt($credentials)) {
            return redirect()->route('inicio')->with('success', 'Bem-vindo(a), Boa sorte!');
        } else {
            return redirect()->back()->with('error', 'Credenciais inválidas!');
        }
    }

    public function logout() {

        Auth::logout();
        return redirect()->route('inicio');
    }

    public function createUser(Request $request) {

        $rules = [
            'name'      => 'required|string',
            'cpf'       => 'required|unique:users',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required',
            'password'  => 'required',
        ];

        $messages = [
            'name.required'     => 'O campo nome é obrigatório.',
            'name.string'       => 'O campo nome deve ser verídico.',
            'cpf.required'      => 'O campo CPF é obrigatório.',
            'cpf.unique'        => 'CPF já cadastrado.',
            'email.required'    => 'O campo email é obrigatório.',
            'email.email'       => 'O campo email deve ser um endereço de e-mail válido.',
            'email.unique'      => 'Email já cadastrado.',
            'phone.required'    => 'O campo telefone é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            return redirect()->back()
                ->with('error', $errorMessage);
        }

        if (!$this->validaCpf($request->cpf)) {
            return redirect()->back()->with('error', 'CPF inválido! Informe um documento válido.');
        }

        $attributes = [
            'name'       => $request->name,
            'cpf'        => str_replace(['.', '-'], '', $request->cpf),
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'phone'      => str_replace(['(', ')', ' ', '-'], '', $request->phone),
            'type'       => 2,
            'id_sponsor' => $request->id_sponsor,
            'wallet'     => 0
        ];
        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('inicio');
    }

    private function validaCpf($cpf) {

        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += (int) $cpf[$i] * (10 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += (int) $cpf[$i] * (11 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        if ($cpf[9] == $digito1 && $cpf[10] == $digito2) {
            return true;
        }

        return false;
    }

    public function wallet() {

        $user = auth()->user();

        $wallet = auth()->user()->wallet;
        $coupon = auth()->user()->id;
        $points = auth()->user()->points;

        $extract = Extract::where('type', 3)->where('id_user', $user->id)->get();
        $awards = Game::where('winner_one', $user->id)->orWhere('winner_two', $user->id)->orWhere('winner_three', $user->id)->get();
        $bets = Bet::where('id_user', $user->id)->get();
        $users = User::where('id_sponsor', $user->id)->get();

        $gamers = Game::where('status', 1)->get();
        $gamers->load(['bets' => function ($query) use ($user) {
            $query->where('id_user', $user->id);
        }]);

        return view('cliente.wallet', 
            [
                'wallet'    => $wallet, 
                'points'    => $points, 
                'coupon'    => $coupon, 
                'extract'   => $extract, 
                'awards'    => $awards, 
                'bets'      => $bets, 
                'gamers'    => $gamers,
                'users'     => $users
            ]
        );
    }
}

<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Game;

class IndexController extends Controller
{
    public function index() {
        $gamers = Game::where('status', 1)->get();

        return view('cliente.index', ['gamers' => $gamers]);
    }

    public function registre($id = null) {

        return view('cliente.registre', ['id' => $id]);
    }

    public function login() {

        return view('cliente.login');
    }

    public function result() {
        return view('cliente.result');
    }

    public function number_option($id) {
        $game = Game::find($id);
        $numbers = Bet::where('id_game', $id)->get();

        return view('cliente.number_options', ['numbers' => $numbers, 'game' => $game]);
    }
}

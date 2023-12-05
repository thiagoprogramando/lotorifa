<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Game;
use App\Models\User;

class IndexController extends Controller
{
    public function index() {

        $gamers = Game::where('status', 1)->withCount([
            'bets' => function ($query) {
                $query->whereNull('id_user')->orWhere('id_user', '');
            }
        ])->get();

        foreach ($gamers as $game) {
            $totalBets = $game->bets_count;
        }

        return view('cliente.index', ['gamers' => $gamers]);
    }

    public function registre($id = null) {

        return view('cliente.registre', ['id_sponsor' => $id]);
    }

    public function login() {

        return view('cliente.login');
    }

    public function result() {

        $games = Game::where('status', 3)->with(['winnerOne', 'winnerTwo', 'winnerThree'])->get();
        return view('cliente.result', ['games' => $games]);
    }

    public function number_option($id) {

        $game = Game::find($id);
        $numbers = Bet::where('id_game', $id)->where(function ($query) {$query->where('status', 'UNLOCKED')->orWhere('status', 'PENDING'); })->orderBy('number', 'asc')->get();

        return view('cliente.number_options', ['numbers' => $numbers, 'game' => $game]);
    }

    public function ranking() {

        $users = User::where('points', '>', 0)->orderByDesc('points')->get();
        return view('cliente.ranking', ['users' => $users]);
    }

    public function affiliate() {

        return view('cliente.affiliate');
    }
}

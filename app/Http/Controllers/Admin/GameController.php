<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller {

    public function game() {
        $games = Game::all();

        return view('dashboard.jogos.game', ['games' => $games]);
    }

    public function viewGame($id) {
        $game = Game::find($id);
        $bet = Bet::where('id_game', $game->id)->get();
        $value = Bet::where('id_game', $game->id)->where('status', 'APPROVED')->sum('value');
        $number = Bet::where('id_game', $game->id)->count();
        $number_approved = Bet::where('id_game', $game->id)->where('status', 'APPROVED')->count();
        
        return view('dashboard.jogos.view', ['game' => $game, 'bet' => $bet, 'value' => $value, 'number' => $number, 'number_approved' => $number_approved]);
    }

    public function createGame(Request $request) {
        $game = new Game();
        $game->title        = $request->title;
        $game->value_number = $request->value_number;
        $game->total_number = $request->total_number;
        $game->id_creator   = Auth::user()->id;
        $game->status = $request->status;
        
        if($game->save()){
            for ($i = 1; $i <= $game->total_number; $i++) {
                $bet            = new Bet();
                $bet->id_game   = $game->id;
                $bet->number    = $i;
                $bet->value     = $game->value_number;
                $bet->save();
            }

            return redirect()->back()->with('success', 'Jogo criados com sucesso!');
        }

        return redirect()->back()->with('error', 'Não conseguimos concluir a operação! Tente novamente.');
    }

    public function deleteGame(Request $request) {
        $game = Game::find($request->id);
    
        if ($game) {
            $game->delete();
            Bet::where('id_game', $request->id)->delete();
    
            return redirect()->back()->with('success', 'O jogo e números foram deletados!');
        }
    
        return redirect()->back()->with('error', 'O jogo não foi encontrado ou não pôde ser excluído!');
    }

    public function blocksBet(Request $request) {
        $bet = Bet::find($request->id);
        $bet->id_user   = 0;
        $bet->token     = 0;
        $bet->status    = 'BLOCK';
        $bet->save();

        return redirect()->back()->with('success', 'Número bloqueado para apostas!');
    }
    
    public function awarded() {
        $premiados = Bet::where('status', 'PREMIADO')->get();

        return view('dashboard.jogos.awarded', ['premiados' => $premiados]);
    }
}

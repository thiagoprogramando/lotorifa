<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Bet;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller {

    public function game() {
        $games = Game::all();

        return view('dashboard.jogos.game', ['games' => $games]);
    }

    public function viewGame($id) {
        //Dados do Concurso
        $game = Game::find($id);
        //Números listagem
        $bet = Bet::where('id_game', $game->id)->get();
        //Números disponiveis total
        $number = Bet::where('id_game', $game->id)->count();
        //Números escolhidos
        $number_approved = Bet::where('id_game', $game->id)->where('status', 'PAYMENT_CONFIRMED')->count();
        //Valor arrecado final
        $value = Bet::where('id_game', $game->id)->where('status', 'PAYMENT_CONFIRMED')->distinct('token')->sum('netValue');
        //Apostas Aprovadas
        $bets_approved = Bet::where('id_game', $game->id)->where('status', 'PAYMENT_CONFIRMED')->distinct('token')->count();
        //Apostadores
        $bettors = Bet::where('id_game', $game->id)->where('status', 'PAYMENT_CONFIRMED')->distinct('id_user')->count();
        
        return view('dashboard.jogos.view', ['game' => $game, 'bet' => $bet, 'value' => $value, 'number' => $number, 'number_approved' => $number_approved, 'bets_approved' => $bets_approved, 'bettors' => $bettors]);
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
                $bet->status    = 'UNLOCKED';
                $bet->save();
            }

            return redirect()->back()->with('success', 'Concurso criado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não conseguimos concluir a operação! Tente novamente.');
    }

    public function deleteGame(Request $request) {

        $game = Game::find($request->id);
        if ($game) {
            $game->delete();
            Bet::where('id_game', $request->id)->delete();
    
            return redirect()->back()->with('success', 'O concurso e números foram deletados!');
        }
    
        return redirect()->back()->with('error', 'O concurso não foi encontrado ou não pôde ser excluído!');
    }

    public function createResult(Request $request) {

        $game = Game::find($request->game);
        if (!$game) {
            return redirect()->back()->with('error', 'O concurso não foi encontrado!');
        }

        $randomBets = Bet::select('id_user', 'number')->where('id_game', $game->id)->distinct('id_user')->inRandomOrder()->limit(3)->get();
        if ($randomBets->count() < 3) {
            return redirect()->back()->with('error', 'Tivemos um pequeno problema, verifique sua conexão e tente novamente!');
        }

        $uniqueIdUsers = $randomBets->pluck('id_user')->unique();
        if ($uniqueIdUsers->count() < 3) {
            return redirect()->back()->with('error', 'Verifique sua conexão e tente novamente!');
        }

        $game->update([
            'winner_one'    => $randomBets[0]->id_user,
            'number_one'    => $randomBets[0]->number,
            'winner_two'    => $randomBets[1]->id_user,
            'number_two'    => $randomBets[1]->number,
            'winner_three'  => $randomBets[2]->id_user,
            'number_three'  => $randomBets[2]->number,
            'status'        => 3
        ]);

        $winners = [
            $randomBets[0]->id_user => 400,
            $randomBets[1]->id_user => 200,
            $randomBets[2]->id_user => 100,
        ];

        foreach ($winners as $userId => $amount) {
            $user = User::find($userId);
            if ($user) {
                $user->update([
                    'wallet' => $user->wallet + $amount,
                ]);
            }
        }

        $winnerNames = [
            User::find($randomBets[0]->id_user)->name,
            User::find($randomBets[1]->id_user)->name,
            User::find($randomBets[2]->id_user)->name,
        ];

        return redirect()->back()->with('success', 'Resultado Gerado: '. implode(', ', $winnerNames));
    }

    public function blocksBet(Request $request) {

        $bet = Bet::find($request->id);
        $bet->id_user   = 0;
        $bet->token     = 0;
        $bet->status    = $request->status;
        $bet->save();

        return redirect()->back()->with('success', 'Número bloqueado!');
    }
    
    public function awarded() {

        $awarded = Bet::where('status', 'PREMIADO')->get();
        return view('dashboard.jogos.awarded', ['awarded' => $awarded]);
    }
}

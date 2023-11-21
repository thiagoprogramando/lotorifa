<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard() {

        $users = User::all()->count();
        $bets = Bet::where('status', 'APPROVED')->count();
        $value = Bet::where('status', 'APPROVED')->sum('value');
        $ciclos = $this->calculateCompletionPercentage();

        $games = Game::where('status', 1)->get();
        foreach ($games as $game) {
            $totalBets = Bet::where('id_game', $game->id)->count();
            $totalApprovedBets = Bet::where('id_game', $game->id)->where('status', 'APPROVED')->count();
    
            if ($totalBets > 0) {
                $percentFulfilled = ($totalApprovedBets / $game->total_number) * 100;
                $percentRemaining = 100 - $percentFulfilled;
            } else {
                $percentFulfilled = 0;
                $percentRemaining = 0;
            }
    
            $game->percentFulfilled = $percentFulfilled;
            $game->percentRemaining = $percentRemaining;
        }

        return view('dashboard.dashboard', ['users' => $users, 'bets' => $bets, 'value' => $value, 'games' => $games, 'ciclos' => $ciclos]);
    }

    public function calculateCompletionPercentage() {
        // Obter todos os jogos com status = 1
        $games = Game::where('status', 1)->get();
    
        $totalGames = $games->count();
        $totalBets = 0;
        $totalApprovedBets = 0;
    
        // Calcular o número total de apostas e o número total de apostas aprovadas
        foreach ($games as $game) {
            $totalBets += $game->total_number;
            $totalApprovedBets += Bet::where('id_game', $game->id)->where('status', 'APPROVED')->count();
        }
    
        // Calcular a porcentagem de conclusão
        if ($totalBets > 0) {
            $completionPercentage = ($totalApprovedBets / $totalBets) * 100;
        } else {
            $completionPercentage = 0; // Evitar divisão por zero
        }
    
        return $completionPercentage;
    }
      
}

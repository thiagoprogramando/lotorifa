<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'game';

    protected $fillable = [
        'title',
        'id_creator',
        'winner_one',
        'number_one',
        'winner_two',
        'number_two',
        'winner_three',
        'number_three',
        'value_number',
        'total_number',
        'status', // 1 - Aberto | 2 - Fechado | 3 - Concluído
    ];

    public function winnerOne() {
        return $this->belongsTo(User::class, 'winner_one');
    }

    public function winnerTwo() {
        return $this->belongsTo(User::class, 'winner_two');
    }

    public function winnerThree() {
        return $this->belongsTo(User::class, 'winner_three');
    }

    public function bets() {
        return $this->hasMany(Bet::class, 'id_game', 'id');
    }

}

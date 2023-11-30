<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $table = 'bet';

    protected $fillable = [
        'id_game',
        'id_user',
        'id_number',
        'value',
        'token',
        'status',
    ];

    public function game() {
        
        return $this->belongsTo(Game::class, 'id_game', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    use HasFactory;

    protected $table = 'extract';

    protected $fillable = [
        'id_user',
        'type',
        'message',
        'value',
    ];
}

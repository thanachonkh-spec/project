<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'league',
        'short',
        'home',
        'away',
        'home_short',
        'away_short',
        'home_color',
        'away_color',
        'match_at',
        'stadium',
        'price',
        'status',
        'featured',
    ];

    protected $casts = [
        'match_at' => 'datetime',
        'price' => 'decimal:2',
        'featured' => 'boolean',
    ];
}

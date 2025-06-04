<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'turn_id',
        'break',
    ];

    // Relaciones
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function turn()
    {
        return $this->belongsTo(Turn::class);
    }
}

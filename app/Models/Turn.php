<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Turn extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
        'start_time',
        'end_time',
    ];

    // Relaciones
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
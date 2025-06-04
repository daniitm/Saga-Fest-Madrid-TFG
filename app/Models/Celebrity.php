<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surnames',
        'email',
        'biography',
        'photo',
        'category',
        'website',
    ];

    // Relaciones
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_celebrity');
    }
}

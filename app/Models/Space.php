<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_code',
        'location_area',
        'space_size',
    ];

    // Relaciones
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'price',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'purchases')->withPivot(['status', 'payment_method', 'transaction_id', 'amount'])->withTimestamps();
    }
}

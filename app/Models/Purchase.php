<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'status',
        'payment_method',
        'transaction_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function markPaid($transactionId, $paymentMethod = 'paypal')
    {
        $this->status = 'paid';
        $this->transaction_id = $transactionId;
        $this->payment_method = $paymentMethod;
        $this->save();
    }

    public function markFailed($transactionId = null, $paymentMethod = 'paypal')
    {
        $this->status = 'failed';
        if ($transactionId) $this->transaction_id = $transactionId;
        $this->payment_method = $paymentMethod;
        $this->save();
    }

    public function markPending()
    {
        $this->status = 'pending';
        $this->save();
    }
}

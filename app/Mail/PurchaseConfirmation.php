<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $generalQty;
    public $premiumQty;
    public $amount;

    public function __construct(User $user, $generalQty, $premiumQty, $amount)
    {
        $this->user = $user;
        $this->generalQty = $generalQty;
        $this->premiumQty = $premiumQty;
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->subject('Confirmación de compra de entradas')
            ->view('emails.purchase-confirmation');
    }
}

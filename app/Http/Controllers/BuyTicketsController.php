<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Ticket\TicketRepositoryInterface;

class BuyTicketsController extends Controller
{
    private $tickets;

    public function __construct(TicketRepositoryInterface $tickets)
    {
        $this->tickets = $tickets;
    }

    public function __invoke()
    {
        if (!Auth::check()) {
            return view('auth.must-login');
        }

        $general = $this->tickets->all()->where('type', 'General')->first();
        $premium = $this->tickets->all()->where('type', 'Premium')->first();
        $qtyGeneral = $this->tickets->getStockCountByType('General');
        $qtyPremium = $this->tickets->getStockCountByType('Premium');

        return view('buy-ticket', [
            'generalPrice' => $general ? $general->price : 0,
            'premiumPrice' => $premium ? $premium->price : 0,
            'qtyGeneral' => $qtyGeneral,
            'qtyPremium' => $qtyPremium,
            'paypalClientId' => config('services.paypal.client_id'),
        ]);
    }
}

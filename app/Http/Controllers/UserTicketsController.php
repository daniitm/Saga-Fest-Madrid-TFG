<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\Purchase\PurchaseRepositoryInterface;

class UserTicketsController extends Controller
{
    private PurchaseRepositoryInterface $purchases;

    public function __construct(PurchaseRepositoryInterface $purchases)
    {
        $this->purchases = $purchases;
    }

    public function index()
    {
        $user = Auth::user();
        $tickets = $this->purchases->getPaidByUserWithTicket($user->id);
        return view('show-tickets', compact('tickets'));
    }
}

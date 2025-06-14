<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Mail\PurchaseConfirmation;

class PurchaseController extends Controller
{
    private $purchases;
    private $tickets;

    public function __construct(PurchaseRepositoryInterface $purchases, TicketRepositoryInterface $tickets)
    {
        $this->purchases = $purchases;
        $this->tickets = $tickets;
    }

    public function store(Request $request)
    {
        $request->validate([
            'orderID' => 'required',
            'general_qty' => 'required|integer|min:0',
            'premium_qty' => 'required|integer|min:0',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $qtyGeneral = (int) $request->general_qty;
        $qtyPremium = (int) $request->premium_qty;
        $totalToBuy = $qtyGeneral + $qtyPremium;

        $alreadyBought = $this->purchases->countPaidByUser($user->id);

        if ($alreadyBought + $totalToBuy > 5) {
            session()->flash('toast', [
                'type' => 'warning',
                'message' => 'No esta permitido comprar más de 5 entradas.'
            ]);
            return response()->json(['reload' => true]);
        }

        $generalTickets = $this->tickets->getAvailableByTypeWithLimit('General', $qtyGeneral);
        $premiumTickets = $this->tickets->getAvailableByTypeWithLimit('Premium', $qtyPremium);

        if ($generalTickets->count() < $qtyGeneral) {
            session()->flash('toast', [
                'type' => 'error',
                'message' => 'No hay suficientes entradas generales disponibles.'
            ]);
            return response()->json(['reload' => true]);
        }
        if ($premiumTickets->count() < $qtyPremium) {
            session()->flash('toast', [
                'type' => 'error',
                'message' => 'No hay suficientes entradas premium disponibles.'
            ]);
            return response()->json(['reload' => true]);
        }

        $expectedTotal = $generalTickets->sum('price') + $premiumTickets->sum('price');
        if (round($expectedTotal, 2) != round($request->amount, 2)) {
            session()->flash('toast', [
                'type' => 'error',
                'message' => 'El precio total no coincide con el precio actual de las entradas.'
            ]);
            return response()->json(['reload' => true]);
        }

        foreach ($generalTickets as $ticket) {
            $this->purchases->create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'status' => 'paid',
                'payment_method' => 'paypal',
                'transaction_id' => $request->orderID,
                'amount' => $ticket->price,
            ]);
        }
        foreach ($premiumTickets as $ticket) {
            $this->purchases->create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'status' => 'paid',
                'payment_method' => 'paypal',
                'transaction_id' => $request->orderID,
                'amount' => $ticket->price,
            ]);
        }

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'Compra realizada con éxito.'
        ]);

        // Enviar correo de confirmación
        Mail::to($user->email)->send(new PurchaseConfirmation($user, $qtyGeneral, $qtyPremium, $request->amount));

        return response()->json(['reload' => true]);
    }
}

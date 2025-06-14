<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\Purchase\PurchaseRepositoryInterface;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private TicketRepositoryInterface $tickets;
    private PurchaseRepositoryInterface $purchases;

    public function __construct(TicketRepositoryInterface $tickets, PurchaseRepositoryInterface $purchases)
    {
        $this->tickets = $tickets;
        $this->purchases = $purchases;
    }

    public function index()
    {
        $tickets = $this->tickets->paginate(15);
        $tipos = $this->tickets->getGroupedTypes();
        $stock = $this->tickets->getStockCount();
        return view('admin.tickets.index', compact('tickets', 'tipos', 'stock'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:General,Premium',
            'quantity' => 'required|integer|min:1|max:100',
            'apply_to_both' => 'sometimes|boolean',
        ], [
            'type.required' => 'Debes escoger un tipo de entrada.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad mínima es 1.',
            'quantity.max' => 'La cantidad máxima es 100.',
        ]);

        $typesToAdd = [$data['type']];
        if (!empty($data['apply_to_both']) && $data['apply_to_both']) {
            $typesToAdd = ['General', 'Premium'];
        }

        foreach ($typesToAdd as $type) {
            // Obtener el precio actual para el tipo, si existe
            $lastTicket = $this->tickets->all()->where('type', $type)->sortByDesc('id')->first();
            $price = $lastTicket ? $lastTicket->price : ($type === 'Premium' ? 74.99 : 49.99);
            for ($i = 0; $i < $data['quantity']; $i++) {
                $this->tickets->create([
                    'type' => $type,
                    'price' => $price,
                ]);
            }
        }

        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => 'Entradas agregadas correctamente.']);
    }

    public function delete()
    {
        return view('admin.tickets.delete');
    }

    public function destroy(Request $request)
    {
        // No permitir eliminar si hay compras
        if ($this->purchases->existsPaid()) {
            return redirect()->route('admin.tickets.index')->with('toast', [
                'type' => 'warning',
                'message' => 'No se pueden eliminar entradas porque ya existe al menos una compra realizada.'
            ]);
        }

        $data = $request->validate([
            'type' => 'required|in:General,Premium',
            'quantity' => 'required|integer|min:1',
            'apply_to_both' => 'sometimes|boolean',
        ], [
            'type.required' => 'Debes escoger un tipo de entrada.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad mínima es 1.',
        ]);

        $typesToDelete = [$data['type']];
        if (!empty($data['apply_to_both']) && $data['apply_to_both']) {
            $typesToDelete = ['General', 'Premium'];
        }

        $totalDeleted = 0;
        $warnings = [];
        foreach ($typesToDelete as $type) {
            $tickets = $this->tickets->all()->where('type', $type)->sortBy('id')->take($data['quantity']);
            if ($tickets->count() < $data['quantity']) {
                $warnings[] = "Solo se han encontrado {$tickets->count()} entradas de tipo {$type} para eliminar.";
            }
            foreach ($tickets as $ticket) {
                $this->tickets->delete($ticket);
                $totalDeleted++;
            }
        }

        if ($totalDeleted === 0) {
            return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'warning', 'message' => 'No hay suficientes entradas para eliminar.']);
        }
        $msg = 'Entradas eliminadas correctamente.';
        if ($warnings) {
            $msg .= ' ' . implode(' ', $warnings);
        }
        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => $msg]);
    }

    public function edit($id)
    {
        $ticket = $this->tickets->find($id);
        if (!$ticket) {
            return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'warning', 'message' => 'Ticket no encontrado.']);
        }
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        // No permitir editar precio si hay compras
        if ($this->purchases->existsPaid()) {
            return redirect()->route('admin.tickets.index')->with('toast', [
                'type' => 'warning',
                'message' => 'No se puede editar el precio porque ya existe al menos una compra realizada.'
            ]);
        }

        $ticket = $this->tickets->find($id);
        if (!$ticket) {
            return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'warning', 'message' => 'Ticket no encontrado.']);
        }
        $data = $request->validate([
            'price' => 'required|numeric|min:25|max:100',
        ], [
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio no puede ser menor que 25€.',
            'price.max' => 'El precio no puede ser mayor que 100€.',
        ]);
        // Actualiza el precio de todas las entradas de ese tipo
        $this->tickets->all()->where('type', $ticket->type)->each(function($t) use ($data) {
            $this->tickets->update($t, ['price' => $data['price']]);
        });
        return redirect()->route('admin.tickets.index')->with('toast', ['type' => 'success', 'message' => 'Precio actualizado correctamente en todas las entradas de tipo ' . $ticket->type . '.']);
    }
}

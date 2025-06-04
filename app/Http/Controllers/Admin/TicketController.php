<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private TicketRepositoryInterface $tickets;

    public function __construct(TicketRepositoryInterface $tickets)
    {
        $this->tickets = $tickets;
    }

    public function index()
    {
        $tickets = $this->tickets->paginate(15);

        $tipos = \App\Models\Ticket::selectRaw('MIN(id) as id, type, price')
            ->whereIn('type', ['General', 'Premium'])
            ->groupBy('type', 'price')
            ->get();

        $stock = \App\Models\Ticket::count(); // Todas las entradas en stock

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
            // Si aplica a ambos tipos, agregamos ambos
            $typesToAdd = ['General', 'Premium'];
        }

        foreach ($typesToAdd as $type) {
            for ($i = 0; $i < $data['quantity']; $i++) {
                $this->tickets->create([
                    'type' => $type,
                    'price' => $type === 'Premium' ? 74.99 : 49.99,
                ]);
            }
        }

        return redirect()->route('admin.tickets.index')->with('success', 'Entradas agregadas correctamente.');
    }

    public function delete()
    {
        return view('admin.tickets.delete');
    }

    public function destroy(Request $request)
    {
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
            $tickets = \App\Models\Ticket::where('type', $type)
                ->orderBy('id')
                ->limit($data['quantity'])
                ->get();
            if ($tickets->count() < $data['quantity']) {
                $warnings[] = "Solo se han encontrado {$tickets->count()} entradas de tipo {$type} para eliminar.";
            }
            foreach ($tickets as $ticket) {
                $ticket->delete();
                $totalDeleted++;
            }
        }

        if ($totalDeleted === 0) {
            return redirect()->route('admin.tickets.index')->with('warning', 'No hay suficientes entradas para eliminar.');
        }
        $msg = 'Entradas eliminadas correctamente.';
        if ($warnings) {
            $msg .= ' ' . implode(' ', $warnings);
        }
        return redirect()->route('admin.tickets.index')->with('success', $msg);
    }

    public function edit($id)
    {
        $ticket = $this->tickets->find($id);
        if (!$ticket) {
            return redirect()->route('admin.tickets.index')->with('warning', 'Ticket no encontrado.');
        }
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = $this->tickets->find($id);
        if (!$ticket) {
            return redirect()->route('admin.tickets.index')->with('warning', 'Ticket no encontrado.');
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
        \App\Models\Ticket::where('type', $ticket->type)->update(['price' => $data['price']]);
        return redirect()->route('admin.tickets.index')->with('success', 'Precio actualizado correctamente en todas las entradas de tipo ' . $ticket->type . '.');
    }
}

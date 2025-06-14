<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Space\SpaceRepositoryInterface;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    private SpaceRepositoryInterface $spaces;

    public function __construct(SpaceRepositoryInterface $spaces)
    {
        $this->spaces = $spaces;
    }

    public function index()
    {
        $areas = ['P0', 'C1', 'C2'];
        $counts = [];
        foreach ($areas as $area) {
            $counts[$area] = $this->spaces->countByArea($area);
        }
        return view('admin.spaces.index', compact('counts'));
    }

    public function create()
    {
        return view('admin.spaces.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'location_area' => ['required', 'string'],
            'space_size' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ], [
            'location_area.required' => 'El área es obligatoria.',
            'space_size.required' => 'El tamaño es obligatorio.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad mínima es 1.',
            'quantity.max' => 'La cantidad máxima es 50.',
        ]);
        $area = $data['location_area'];
        $size = $data['space_size'];
        $quantity = $data['quantity'];
        $currentCount = $this->spaces->countByArea($area);
        if ($currentCount >= 50) {
            return redirect()->route('admin.spaces.index')->with('toast', [
                'type' => 'warning',
                'message' => 'No se pueden crear más espacios en el área ' . $area . ' porque ya hay 50 o más.'
            ]);
        }
        $toCreate = min($quantity, 50 - $currentCount);
        $created = 0;
        for ($i = 0; $i < $toCreate; $i++) {
            $code = $area . '-' . str_pad($currentCount + $i + 1, 3, '0', STR_PAD_LEFT);
            $this->spaces->create([
                'location_code' => $code,
                'location_area' => $area,
                'space_size' => $size,
            ]);
            $created++;
        }
        if ($created < $quantity) {
            return redirect()->route('admin.spaces.index')->with('toast', [
                'type' => 'warning',
                'message' => 'Solo se crearon ' . $created . ' espacios porque el área ya tiene 50.'
            ]);
        }
        return redirect()->route('admin.spaces.index')->with('toast', [
            'type' => 'success',
            'message' => 'Espacios creados correctamente.'
        ]);
    }

    public function delete()
    {
        return view('admin.spaces.delete');
    }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'location_area' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1', 'max:50'],
        ], [
            'location_area.required' => 'El área es obligatoria.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número.',
            'quantity.min' => 'La cantidad mínima es 1.',
            'quantity.max' => 'La cantidad máxima es 50.',
        ]);
        $area = $data['location_area'];
        $quantity = $data['quantity'];
        $spaces = $this->spaces->all()->where('location_area', $area)
            ->filter(function($space) { return $space->events->isEmpty(); })
            ->sortBy('id')
            ->take($quantity);
        if ($spaces->count() < $quantity) {
            return redirect()->route('admin.spaces.index')->with('toast', ['type' => 'warning', 'message' => 'No hay suficientes espacios libres para eliminar. Solo hay ' . $spaces->count() . ' espacios sin eventos asignados.']);
        }
        foreach ($spaces as $space) {
            $this->spaces->delete($space);
        }
        return redirect()->route('admin.spaces.index')->with('toast', ['type' => 'success', 'message' => 'Espacios eliminados correctamente.']);
    }
}

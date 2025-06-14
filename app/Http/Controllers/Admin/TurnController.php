<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Turn\TurnRepositoryInterface;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    private TurnRepositoryInterface $turns;

    public function __construct(TurnRepositoryInterface $turns)
    {
        $this->turns = $turns;
    }

    public function index()
    {
        $turns = $this->turns->paginate(15);
        return view('admin.turns.index', compact('turns'));
    }

    public function show($id)
    {
        $turn = $this->turns->find($id);
        return view('admin.turns.show', compact('turn'));
    }

    public function create()
    {
        return view('admin.turns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'name' => 'required|in:Mañana,Tarde',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $this->turns->create($data);

        return redirect()->route('admin.turns.index')->with('toast', ['type' => 'success', 'message' => 'Turno creado correctamente.']);
    }

    public function edit($id)
    {
        $turn = $this->turns->find($id);
        return view('admin.turns.edit', compact('turn'));
    }

    public function update(Request $request, $id)
    {
        $turn = $this->turns->find($id);

        $data = $request->validate([
            'date' => 'required|date',
            'name' => 'required|in:Mañana,Tarde',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $this->turns->update($turn, $data);

        return redirect()->route('admin.turns.index')->with('toast', ['type' => 'success', 'message' => 'Turno actualizado correctamente.']);
    }

    public function destroy($id)
    {
        $turn = $this->turns->find($id);
        $this->turns->delete($turn);

        return redirect()->route('admin.turns.index')->with('toast', ['type' => 'success', 'message' => 'Turno eliminado correctamente.']);
    }
}
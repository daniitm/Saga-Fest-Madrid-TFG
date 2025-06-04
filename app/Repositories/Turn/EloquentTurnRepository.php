<?php

namespace App\Repositories\Turn;

use App\Models\Turn;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentTurnRepository implements TurnRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Turn::orderBy('date')->orderBy('start_time')->paginate($perPage);
    }

    public function all(): Collection
    {
        return Turn::orderBy('date')->orderBy('start_time')->get();
    }

    public function find($id): ?Turn
    {
        return Turn::find($id);
    }

    public function create(array $data): Turn
    {
        return Turn::create($data);
    }

    public function update(Turn $turn, array $data): Turn
    {
        $turn->update($data);
        return $turn;
    }

    public function delete(Turn $turn): bool
    {
        return $turn->delete();
    }
}
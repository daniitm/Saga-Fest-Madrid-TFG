<?php

namespace App\Repositories\Space;

use App\Models\Space;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentSpaceRepository implements SpaceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Space::orderBy('id', 'desc')->paginate($perPage);
    }

    public function all(): Collection
    {
        return Space::orderBy('id', 'desc')->get();
    }

    public function find($id): ?Space
    {
        return Space::find($id);
    }

    public function findByIdentity(array $data): ?Space
    {
        return Space::where($data)->first();
    }

    public function create(array $data): Space
    {
        return Space::create($data);
    }

    public function update(Space $space, array $data): Space
    {
        $space->update($data);
        return $space;
    }

    public function delete(Space $space): bool
    {
        return $space->delete();
    }

    public function countByArea(string $locationArea): int
    {
        return Space::where('location_area', $locationArea)->count();
    }
}

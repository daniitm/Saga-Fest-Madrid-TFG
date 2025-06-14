<?php

namespace App\Repositories\Exposition;

use App\Models\Exposition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentExpositionRepository implements ExpositionRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Exposition::orderBy('id', 'desc')->paginate($perPage);
    }

    public function search(string $search): Collection
    {
        return Exposition::where('company_name', 'like', "%{$search}%")
            ->orWhere('contact_person', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('stand_category', 'like', "%{$search}%")
            ->get();
    }

    public function all(): Collection
    {
        return Exposition::orderBy('id', 'desc')->get();
    }

    public function find($id): ?Exposition
    {
        return Exposition::where('id', $id)->first();
    }

    public function findByIdentity(array $data): ?Exposition
    {
        return Exposition::where($data)->first();
    }

    public function create(array $data): Exposition
    {
        return Exposition::create($data);
    }

    public function update(Exposition $exposition, array $data): Exposition
    {
        $exposition->update($data);
        return $exposition;
    }

    public function delete(Exposition $exposition): bool
    {
        return $exposition->delete();
    }

    public function deleteById($id): bool
    {
        $exposition = Exposition::find($id);
        if (!$exposition) return false;
        return $exposition->delete();
    }

    public function countByStandCategory(string $standCategory): int
    {
        return Exposition::where('stand_category', $standCategory)->count();
    }
    
    public function countByImageExceptId(string $image, $exceptId): int
    {
        return Exposition::where('image', $image)->where('id', '!=', $exceptId)->count();
    }

    public function countByImage(string $image): int
    {
        return Exposition::where('image', $image)->count();
    }

    public function paginateWithSearch(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        $query = Exposition::query();
        if ($search) {
            $query->where('company_name', 'like', "%{$search}%");
        }
        return $query->orderBy('id', 'desc')->paginate($perPage);
    }
}

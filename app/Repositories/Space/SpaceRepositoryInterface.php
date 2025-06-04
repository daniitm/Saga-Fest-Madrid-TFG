<?php

namespace App\Repositories\Space;

use App\Models\Space;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface SpaceRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    
    public function all(): Collection;
    
    public function find($id): ?Space;
    
    public function findByIdentity(array $data): ?Space;
    
    public function create(array $data): Space;
    
    public function update(Space $space, array $data): Space;
    
    public function delete(Space $space): bool;
    
    public function countByArea(string $locationArea): int;
}

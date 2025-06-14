<?php

namespace App\Repositories\Exposition;

use App\Models\Exposition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ExpositionRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    
    public function search(string $search): Collection;
    
    public function all(): Collection;
    
    public function find($id): ?Exposition;
    
    public function findByIdentity(array $data): ?Exposition;
    
    public function create(array $data): Exposition;
    
    public function update(Exposition $exposition, array $data): Exposition;
    
    public function delete(Exposition $exposition): bool;

    public function deleteById($id): bool;

    public function countByStandCategory(string $standCategory): int;

    public function countByImageExceptId(string $image, $exceptId): int;
    public function countByImage(string $image): int;

    public function paginateWithSearch(?string $search, int $perPage = 10): LengthAwarePaginator;
}

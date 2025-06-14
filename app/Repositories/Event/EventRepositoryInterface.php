<?php

namespace App\Repositories\Event;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EventRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    
    public function search(string $search): Collection;
    
    public function all(): Collection;
    
    public function find($id): ?Event;
    
    public function findByIdentity(array $data): ?Event;
    
    public function create(array $data): Event;
    
    public function update(Event $event, array $data): Event;
    
    public function delete(Event $event): bool;

    public function deleteById($id): bool;

    public function countByStandCategory(string $standCategory): int;

    public function countByImageExceptId(string $image, $exceptId): int;
    public function countByImage(string $image): int;

    public function paginateWithSearch(?string $search, int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
}

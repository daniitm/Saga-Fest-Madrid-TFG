<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TicketRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function search(string $search): Collection;
    
    public function all(): Collection;
    
    public function find($id): ?Ticket;
    
    public function create(array $data): Ticket;
    
    public function update(Ticket $ticket, array $data): Ticket;
    
    public function delete(Ticket $ticket): bool;

    public function getByTypeWithLimit(string $type, int $limit): Collection;

    public function getAvailableByTypeWithLimit(string $type, int $limit): Collection;

    /**
     * Get ticket types with min id and price grouped by type and price.
     */
    public function getGroupedTypes(): Collection;

    /**
     * Get the count of tickets in stock (not purchased/paid).
     */
    public function getStockCount(): int;

    /**
     * Get the count of tickets in stock for a specific type.
     */
    public function getStockCountByType(string $type): int;
}

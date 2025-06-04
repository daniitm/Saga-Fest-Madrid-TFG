<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentTicketRepository implements TicketRepositoryInterface
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
        return Ticket::orderBy('id', 'desc')->paginate($perPage);
    }

    public function search(string $search): Collection
    {
        return Ticket::where('type', 'like', "%{$search}%")->get();
    }

    public function all(): Collection
    {
        return Ticket::orderBy('id', 'desc')->get();
    }

    public function find($id): ?Ticket
    {
        return Ticket::find($id);
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function update(Ticket $ticket, array $data): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete();
    }

    public function getByTypeWithLimit(string $type, int $limit): Collection
    {
        return Ticket::where('type', $type)
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->get();
    }
}

<?php

namespace App\Repositories\Event;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentEventRepository implements EventRepositoryInterface
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
        return Event::orderBy('id', 'desc')->paginate($perPage);
    }

    public function search(string $search): Collection
    {
        return Event::where('company_name', 'like', "%{$search}%")
            ->orWhere('contact_person', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('stand_category', 'like', "%{$search}%")
            ->get();
    }

    public function all(): Collection
    {
        return Event::orderBy('id', 'desc')->get();
    }

    public function find($id): ?Event
    {
        return Event::find($id);
    }

    public function findByIdentity(array $data): ?Event
    {
        return Event::where($data)->first();
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event): bool
    {
        return $event->delete();
    }

    public function deleteById($id): bool
    {
        $event = Event::find($id);
        if (!$event) return false;
        return $event->delete();
    }

    public function countByStandCategory(string $standCategory): int
    {
        return Event::where('stand_category', $standCategory)->count();
    }
}

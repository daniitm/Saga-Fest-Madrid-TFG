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
        // El repositorio solo actualiza el modelo, no gestiona imágenes
        $event->update($data);
        return $event;
    }

    public function delete(Event $event): bool
    {
        // El repositorio solo elimina el modelo, no gestiona imágenes
        return $event->delete();
    }

    public function deleteById($id): bool
    {
        $event = Event::find($id);
        if (!$event) return false;
        // El repositorio solo elimina el modelo, no gestiona imágenes
        return $event->delete();
    }

    public function countByStandCategory(string $standCategory): int
    {
        return Event::where('stand_category', $standCategory)->count();
    }
    
    public function countByImageExceptId(string $image, $exceptId): int
    {
        return Event::where('image', $image)->where('id', '!=', $exceptId)->count();
    }

    public function countByImage(string $image): int
    {
        return Event::where('image', $image)->count();
    }

    public function paginateWithSearch(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        $query = Event::query();
        if ($search) {
            $query->where('company_name', 'like', "%{$search}%");
        }
        return $query->orderBy('id', 'desc')->paginate($perPage);
    }
}

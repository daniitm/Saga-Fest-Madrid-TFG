<?php

namespace App\Repositories\Celebrity;

use App\Models\Celebrity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentCelebrityRepository implements CelebrityRepositoryInterface
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
        return Celebrity::orderBy('id', 'desc')->paginate($perPage);
    }

    public function search(string $search): Collection
    {
        return Celebrity::where('name', 'like', "%{$search}%")
            ->orWhere('surnames', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('category', 'like', "%{$search}%")
            ->get();
    }

    public function all(): Collection
    {
        return Celebrity::orderBy('id', 'desc')->get();
    }

    public function find($email): ?Celebrity
    {
        return Celebrity::where('email', $email)->first();
    }

    public function findById($id): ?Celebrity
    {
        return Celebrity::find($id);
    }

    public function findByIdentity(array $data): ?Celebrity
    {
        return Celebrity::where($data)->first();
    }

    public function create(array $data): Celebrity
    {
        return Celebrity::create($data);
    }

    public function update(Celebrity $celebrity, array $data): Celebrity
    {
        $celebrity->update($data);
        return $celebrity;
    }

    public function delete(Celebrity $celebrity): bool
    {
        return $celebrity->delete();
    }
    
    public function countByPhoto(string $photo): int
    {
        return Celebrity::where('photo', $photo)->count();
    }

    public function getRandom(int $count = 6): Collection
    {
        return Celebrity::inRandomOrder()->limit($count)->get();
    }

    public function getAvailableForEvent(string $date, string $turnName, string $startTime, string $endTime, ?int $excludeEventId = null): Collection
    {
        // Get IDs of celebrities busy in overlapping events
        $busyCelebrityIds = \App\Models\Event::whereHas('celebrities')
            ->whereHas('schedule.turn', function($q) use ($date, $turnName) {
                $q->where('date', $date)
                  ->where('name', $turnName);
            })
            ->when($excludeEventId, function($q) use ($excludeEventId) {
                $q->where('id', '!=', $excludeEventId);
            })
            ->where(function($q) use ($startTime, $endTime) {
                $q->whereBetween('event_start_time', [$startTime, $endTime])
                  ->orWhereBetween('event_end_time', [$startTime, $endTime])
                  ->orWhere(function($q2) use ($startTime, $endTime) {
                      $q2->where('event_start_time', '<=', $startTime)
                         ->where('event_end_time', '>=', $endTime);
                  });
            })
            ->with('celebrities')
            ->get()
            ->pluck('celebrities')
            ->flatten()
            ->pluck('id')
            ->unique()
            ->toArray();

        return Celebrity::whereNotIn('id', $busyCelebrityIds)->orderBy('name')->get();
    }

    public function paginateWithSearch(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        $query = Celebrity::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('surnames', 'like', "%{$search}%");
            });
        }
        return $query->orderBy('id', 'desc')->paginate($perPage);
    }
}

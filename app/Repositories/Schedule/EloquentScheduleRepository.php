<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentScheduleRepository implements ScheduleRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Schedule::with('turn')->orderBy('id', 'desc')->paginate($perPage);
    }

    public function all(): Collection
    {
        return Schedule::with('turn')->orderBy('id', 'desc')->get();
    }

    public function find($id): ?Schedule
    {
        return Schedule::with('turn')->find($id);
    }

    public function findByIdentity(array $data): ?Schedule
    {
        return Schedule::where($data)->first();
    }

    public function create(array $data): Schedule
    {
        return Schedule::create($data);
    }

    public function update(Schedule $schedule, array $data): Schedule
    {
        $schedule->update($data);
        return $schedule;
    }

    public function delete(Schedule $schedule): bool
    {
        return $schedule->delete();
    }
}
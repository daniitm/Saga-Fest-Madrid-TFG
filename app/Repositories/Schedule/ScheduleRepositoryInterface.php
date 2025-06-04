<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ScheduleRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    
    public function all(): Collection;
    
    public function find($id): ?Schedule;
    
    public function findByIdentity(array $data): ?Schedule;
    
    public function create(array $data): Schedule;
    
    public function update(Schedule $schedule, array $data): Schedule;
    
    public function delete(Schedule $schedule): bool;
}

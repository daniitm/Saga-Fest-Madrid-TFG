<?php

namespace App\Repositories\Turn;

use App\Models\Turn;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TurnRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    
    public function all(): Collection;
    
    public function find($id): ?Turn;
    
    public function create(array $data): Turn;
    
    public function update(Turn $turn, array $data): Turn;
    
    public function delete(Turn $turn): bool;
}
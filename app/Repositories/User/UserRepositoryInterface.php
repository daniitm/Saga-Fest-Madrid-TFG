<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filters = []);

    public function all();
    
    public function find($id);
}

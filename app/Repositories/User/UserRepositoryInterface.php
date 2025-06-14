<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function paginate(int $perPage = 10, array $filters = []);

    public function all();
    
    public function find($id);

    /**
     * Return paginated users with paid purchases count as purchases_count attribute.
     */
    public function paginateWithPurchasesCount(int $perPage = 10, array $filters = []);
}

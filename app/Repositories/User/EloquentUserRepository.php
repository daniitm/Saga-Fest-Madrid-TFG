<?php

namespace App\Repositories\User;

use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    private User $model;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->model = new User;
    }

    public function paginate(int $perPage = 10, array $filters = [])
    {
        $query = User::query();

        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }

        return $query->orderBy('id', 'desc')->paginate($perPage);
    }

    public function all()
    {
        return User::orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return User::find($id);
    }
    
    public function paginateWithPurchasesCount(int $perPage = 10, array $filters = [])
    {
        $query = User::query();
        if (isset($filters['role'])) {
            $query->where('role', $filters['role']);
        }
        return $query->withCount(['purchases as purchases_count' => function($q) {
            $q->where('status', 'paid');
        }])->orderBy('id', 'desc')->paginate($perPage);
    }
}

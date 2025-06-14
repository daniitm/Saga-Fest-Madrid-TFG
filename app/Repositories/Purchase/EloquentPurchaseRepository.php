<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase;

class EloquentPurchaseRepository implements PurchaseRepositoryInterface
{
    public function countPaidByUser(int $userId): int
    {
        return Purchase::where('user_id', $userId)
            ->where('status', 'paid')
            ->count();
    }

    public function existsPaid(): bool
    {
        return Purchase::where('status', 'paid')->exists();
    }

    public function create(array $data): Purchase
    {
        return Purchase::create($data);
    }

    public function getPaidByUserWithTicket(int $userId)
    {
        return Purchase::with('ticket')
            ->where('user_id', $userId)
            ->where('status', 'paid')
            ->get();
    }
}

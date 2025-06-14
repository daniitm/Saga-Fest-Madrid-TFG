<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase;

interface PurchaseRepositoryInterface
{
    public function countPaidByUser(int $userId): int;
    public function existsPaid(): bool;
    public function create(array $data): Purchase;
    public function getPaidByUserWithTicket(int $userId);
}

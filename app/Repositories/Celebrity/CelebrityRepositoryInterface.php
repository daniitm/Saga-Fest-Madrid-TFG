<?php

namespace App\Repositories\Celebrity;

use App\Models\Celebrity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CelebrityRepositoryInterface
{
    /**
     * Get paginated list of celebrities
     *
     * @param  int  $perPage  Number of items per page
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Search celebrities by specific criteria
     *
     * @param  string  $search  Search term
     * @return Collection
     */
    public function search(string $search): Collection;

    /**
     * Get all celebrities
     *
     * @return Collection|static[]
     */
    public function all(): Collection;

    /**
     * Find a celebrity by email
     *
     * @param  mixed  $email  Celebrity's email
     * @return Celebrity|null
     */
    public function find($email): ?Celebrity;

    /**
     * Find a celebrity by ID
     *
     * @param  mixed  $id
     * @return Celebrity|null
     */
    public function findById($id): ?Celebrity;

    /**
     * Find a celebrity by identity
     *
     * @param  array  $data  Celebrity data
     * @return Celebrity|null
     */
    public function findByIdentity(array $data): ?Celebrity;

    /**
     * Create a new celebrity
     *
     * @param  array  $data  Celebrity data
     * @return Celebrity
     */
    public function create(array $data): Celebrity;

    /**
     * Update a celebrity's data
     *
     * @param  Celebrity  $celebrity  Celebrity instance to update
     * @param  array  $data  New celebrity data
     * @return Celebrity
     */
    public function update(Celebrity $celebrity, array $data): Celebrity;

    /**
     * Delete a celebrity
     *
     * @param  Celebrity  $celebrity  Celebrity instance to delete
     * @return bool
     */
    public function delete(Celebrity $celebrity): bool;

    /**
     * Count how many celebrities are using a given photo
     *
     * @param  string  $photo
     * @return int
     */
    public function countByPhoto(string $photo): int;

    /**
     * Get a random selection of celebrities
     *
     * @param  int  $count
     * @return Collection
     */
    public function getRandom(int $count = 6): Collection;

    /**
     * Get celebrities available for a given date, turn, and time range.
     *
     * @param string $date
     * @param string $turnName
     * @param string $startTime
     * @param string $endTime
     * @param int|null $excludeEventId
     * @return Collection
     */
    public function getAvailableForEvent(string $date, string $turnName, string $startTime, string $endTime, ?int $excludeEventId = null): Collection;

    /**
     * Get paginated list of celebrities with search
     *
     * @param  string|null  $search  Search term
     * @param  int  $perPage  Number of items per page
     * @return LengthAwarePaginator
     */
    public function paginateWithSearch(?string $search, int $perPage = 10): LengthAwarePaginator;
}

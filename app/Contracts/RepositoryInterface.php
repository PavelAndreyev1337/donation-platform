<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all entities.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Create entity.
     *
     * @param  array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update entity.
     *
     * @param  array $data
     * @param  int $id
     * @return void
     */
    public function update(array $data, int $id): void;

    /**
     * Delete entity by id.
     *
     * @param  int $id
     * @return void
     */
    public function delete(int $id): void;

    /**
     * Show entity by id.
     *
     * @param  int $id
     * @return Model
     */
    public function show(int $id): Model;
}

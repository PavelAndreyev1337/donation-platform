<?php

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DonationRepositories implements RepositoryInterface
{
    /**
     * Model
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * DonationRepository constructor.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all donations.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Create new donation.
     *
     * @param  array $data
     * @return void
     */
    public function create(array $data): void
    {
        $this->model->create($data);
    }

    /**
     * Update donation.
     *
     * @param  array $data
     * @param  int $id
     * @return void
     */
    public function update(array $data, int $id): void
    {
        $this->model->find($id)->update($data);
    }

    /**
     * Delete donation by id.
     *
     * @param  int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    /**
     * Show donation by id.
     *
     * @param  int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function show(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
}

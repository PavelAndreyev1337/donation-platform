<?php

namespace App\Repositories;

use App\Contracts\DonationRepositoryInterface;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as SupportCollection;

class DonationRepository implements DonationRepositoryInterface
{
    /**
     * Model.
     * 
     * @var Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * DonationRepository constructor.
     *
     * @param  Donation $model
     * @return void
     */
    public function __construct(Donation $model)
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
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update donation.
     *
     * @param  array $data
     * @param  int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Delete donation by id.
     *
     * @param  int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
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

    /**
     * Get the top donator.
     *
     * @return Model
     */
    public function getTopDonator(): Model
    {
        return $this->model->orderBy('amount', 'desc')->select('amount', 'name')->first();
    }

    /**
     * Get sum of donations per day.
     *
     * @return float
     */
    public function getDayAmount(): float
    {
        return $this->model->whereDay('created_at', now()->today())->sum('amount');
    }

    /**
     * Get sum of donations per month.
     *
     * @return float
     */
    public function getMonthAmount(): float
    {
        return $this->model->whereMonth('created_at', now()->month)->sum('amount');
    }

    /**
     * Get amount of donations by day.
     *
     * @return Collection
     */
    public function getAmountByDay(): SupportCollection
    {
        return $this->model->get()->groupBy(function ($row) {
            return $row->created_at->format('d.m.Y');
        })->map(function ($row) {
            return $row->sum('amount');
        });
    }

    /**
     * Paginate donations ordered by descend amount.
     *
     * @param  int $page
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateOrderedDonations(int $page): LengthAwarePaginator
    {
        return $this->model->orderByDesc('amount')->paginate(10);
    }
}

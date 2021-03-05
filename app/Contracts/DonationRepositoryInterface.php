<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface DonationRepositoryInterface extends RepositoryInterface
{
    /**
     * Get the top donator.
     *
     * @return Model
     */
    public function getTopDonator(): Model;

    /**
     * Get sum of donations per day.
     *
     * @return float
     */
    public function getDayAmount(): float;

    /**
     * Get sum of donations per month.
     *
     * @return float
     */
    public function getMonthAmount(): float;

    /**
     * Get amount of donations by day.
     *
     * @return Illuminate\Support\Collection
     */
    public function getAmountByDay(): Collection;

    /**
     * Paginate donations.
     *
     * @param  int $page
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateOrderedDonations(int $page): LengthAwarePaginator;
}

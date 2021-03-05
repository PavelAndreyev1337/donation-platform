<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Decimal;

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
     * @return Decimal
     */
    public function getDayAmount(): Decimal;

    /**
     * Get sum of donations per month.
     *
     * @return Decimal
     */
    public function getMonthAmount(): Decimal;

    /**
     * Get amount of donations by day.
     *
     * @return array
     */
    public function getAmountByDay(): array;

    /**
     * Paginate donations.
     *
     * @param  int $page
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateOrderedDonations(int $page): LengthAwarePaginator;
}

<?php

namespace App\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface DonationServiceInterface
{
    /**
     * Get data for statistics.
     *
     * @return array
     */
    public function getStatistics(): array;

    /**
     * Get donations data for chart.
     *
     * @return array
     */
    public function getChartData(): array;

    /**
     * Save donations to database and return instance.
     *
     * @param  array $data
     * @return Model
     */
    public function addDonation(array $data): Model;

    /**
     * Paginate donations.
     *
     * @param  int $page
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $page): LengthAwarePaginator;
}

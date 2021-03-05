<?php

namespace App\Services;

use App\Contracts\DonationRepositoryInterface;
use App\Contracts\DonationServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class DonationService implements DonationServiceInterface
{
    /**
     * Repository.
     * 
     * @var App\Contracts\DonationRepositoryInterface
     */
    private $repository;

    /**
     * DonationService constructor.
     *
     * @param  App\Contracts\DonationRepositoryInterface $repository
     * @return void
     */
    public function __construct(DonationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get data for statistics.
     *
     * @return array
     */
    public function getStatistics(): array
    {
        return [
            'topDonator' => $this->repository->getTopDonator(),
            'dayAmount' => $this->repository->getDayAmount(),
            'monthAmount' => $this->repository->getMonthAmount()
        ];
    }

    /**
     * Get donations data for chart.
     *
     * @return array
     */
    public function getChartData(): array
    {
        return $this->repository->getAmountByDay();
    }

    /**
     * Save donations to database and return instance.
     *
     * @param  array $data
     * @return Model
     */
    public function addDonation(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * Paginate donations.
     *
     * @param  int $page
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $page): LengthAwarePaginator
    {
        return $this->repository->paginateOrderedDonations($page);
    }
}

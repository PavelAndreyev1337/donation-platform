<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\DonationServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Resources\DonationResource;

class DonationController extends Controller
{
    private $service;

    public function __construct(DonationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->service->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreDonationRequest  $request
     * @return App\Http\Resources\DonationResource
     */
    public function store(StoreDonationRequest $request)
    {
        return new DonationResource(
            $this->service->addDonation($request->only(['name', 'email', 'amount', 'message']))
        );
    }

    /**
     * Get donations statistics.
     *
     * @return array
     */
    public function getStatistics()
    {
        return $this->service->getStatistics();
    }

    /**
     * Get data for chart.
     *
     * @return array
     */
    public function getChartData()
    {
        return $this->service->getChartData();
    }
}

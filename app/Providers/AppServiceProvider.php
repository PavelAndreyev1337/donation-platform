<?php

namespace App\Providers;

use App\Contracts\DonationRepositoryInterface;
use App\Contracts\DonationServiceInterface;
use App\Repositories\DonationRepository;
use App\Services\DonationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
        $this->app->bind(DonationServiceInterface::class, DonationService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

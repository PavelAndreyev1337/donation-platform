<?php

namespace Tests\Feature;

use App\Contracts\DonationServiceInterface;
use App\Models\Donation;
use App\Services\DonationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response as HttpResponse;
use Mockery;
use Tests\TestCase;

class DonationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = Mockery::mock(DonationService::class);
        app()->instance(DonationServiceInterface::class, $this->service);
    }

    /** @test */
    public function test_index()
    {
        $this->service->shouldReceive('paginate')->once()->with(10)->andReturn(Donation::paginate());
        $response = $this->get(route('donations.index', [], false));
        $response->assertStatus(HttpResponse::HTTP_OK);
    }

    /** @test */
    public function test_store()
    {
        $donation = Donation::factory()->make();
        $this->service->shouldReceive('addDonation')->once()->andReturn($donation);
        $response = $this->post(route('donations.store', [], false), $donation->toArray());
        $response->assertStatus(HttpResponse::HTTP_OK);
    }

    /** @test */
    public function test_get_statistics()
    {
        $this->service->shouldReceive('getStatistics')->once()->andReturn([]);
        $response = $this->get(route('statistics', [], false));
        $response->assertStatus(HttpResponse::HTTP_OK);
    }

    /** @test */
    public function test_get_chart_data()
    {
        $this->service->shouldReceive('getChartData')->once()->andReturn([]);
        $response = $this->get(route('chart', [], false));
        $response->assertStatus(HttpResponse::HTTP_OK);
    }
}

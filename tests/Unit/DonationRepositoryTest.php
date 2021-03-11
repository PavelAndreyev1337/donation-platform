<?php

namespace Tests\Unit;

use App\Contracts\DonationRepositoryInterface;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app(DonationRepositoryInterface::class);
        $this->table = "donations";
    }

    /** @test */
    public function test_all()
    {
        $this->assertEquals(
            Donation::factory()->count(3)->create()->toArray(),
            $this->repository->all()->toArray()
        );
    }

    /** @test */
    public function test_create()
    {
        $this->assertDatabaseHas(
            $this->table,
            $this->repository->create(Donation::factory()->make()->toArray())->toArray()
        );
    }

    /** @test */
    public function test_update()
    {
        $donation = Donation::factory()->create();
        $this->assertTrue(
            $this->repository->update(Donation::factory()->make()->toArray(), $donation->id)
        );
        $this->assertDatabaseHas(
            $this->table,
            Donation::find($donation->id)->toArray()
        );
    }

    /** @test */
    public function test_delete()
    {
        $donation = Donation::factory()->create();
        $this->assertTrue($this->repository->delete($donation->id));
        $this->assertDatabaseMissing(
            $this->table,
            $donation->toArray()
        );
    }

    /** @test */
    public function test_show()
    {
        $donation = Donation::factory()->create();
        $this->assertEquals(
            $donation->id,
            $this->repository->show($donation->id)->id
        );
    }

    /** @test */
    public function test_get_top_donator()
    {
        $maxDonation = Donation::factory()->count(10)->create()->max('amount');
        $this->assertEquals(
            $maxDonation,
            $this->repository->getTopDonator()->amount
        );
    }

    /** @test */
    public function test_get_day_amount()
    {
        $today = now()->today();
        $this->assertEquals(
            Donation::factory()->count(20)->create(
                [
                    'created_at' => $today,
                    'updated_at' => $today
                ]
            )->sum('amount'),
            $this->repository->getDayAmount()
        );
    }

    /** @test */
    public function test_get_month_amount()
    {
        $this->assertEquals(
            Donation::factory()->count(20)->create(
                [
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )->sum('amount'),
            $this->repository->getMonthAmount()
        );
    }

    /** @test */
    public function test_get_amount_by_day()
    {
        collect([now(), now()->addDay()])->each(function ($item) {
            $donations = Donation::factory()->count(5)->create(
                [
                    'created_at' => $item,
                    'updated_at' => $item,
                ]
            );
            $this->assertEquals(
                $donations->sum('amount'),
                $this->repository->getAmountByDay()->last()
            );
        });
    }

    /** @test */
    public function test_paginate_ordered_donations()
    {
        Donation::factory()->count(10)->create();
        $this->assertEquals(
            10,
            $this->repository->paginateOrderedDonations(1)->count()
        );
    }
}

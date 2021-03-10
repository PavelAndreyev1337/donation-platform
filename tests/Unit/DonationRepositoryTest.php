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
        Donation::factory()->count(3)->create();
        $this->assertDatabaseHas(
            $this->table,
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
        $this->assertDatabaseHas(
            $this->table,
            $donation->toArray()
        );
    }
}

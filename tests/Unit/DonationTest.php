<?php

namespace Tests\Unit;

use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_donation_can_be_instantiated()
    {
        $donation = Donation::factory()->create();
        $this->assertDatabaseHas("donations", $donation->toArray());
    }
}

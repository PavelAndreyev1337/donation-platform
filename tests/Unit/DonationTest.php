<?php

namespace Tests\Unit;

use App\Models\Donation;
use Tests\TestCase;

class DonationTest extends TestCase
{
    /**
     * Test donation can be instantiated.
     *
     * @return void
     */
    public function test_donation_can_be_instantiated()
    {
       $donation = Donation::factory()->create();
       $this->assertDatabaseHas("donations", $donation->toArray());
    }
}

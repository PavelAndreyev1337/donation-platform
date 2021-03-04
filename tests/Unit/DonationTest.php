<?php

namespace Tests\Unit;

use Tests\TestCase;

class DonationTest extends TestCase
{
    /**
     * Test donation creation.
     *
     * @return void
     */
    public function testCanCreateDonation()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'amount' => rand(0, 100),
            'message' => $this->faker->sentence(5)
        ];
        $this->post(route('donations.store'), $data)->assertStatus(201);
    }

    /**
     * Test donation outputting.
     *
     * @return void
     */
    public function testCanListPost()
    {
        $this->get(route('donations.index'))->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

use App\Models\Donation;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response as HttpResponse;
use Tests\TestCase;

class StoreDonationRequestTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function request_should_fail_when_no_name_is_provided()
    {
        $response = $this->postJson(
            route('donations.store'),
            Donation::factory()->make(['name' => ''])->toArray()
        );
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function request_should_fail_when_no_email_is_provided()
    {
        $response = $this->postJson(
            route('donations.store'),
            Donation::factory()->make(['email' => 'some.com'])->toArray()
        );
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function request_should_fail_when_no_amount_is_provided()
    {
        $response = $this->postJson(
            route('donations.store'),
            Donation::factory()->make(['amount' => 0.001])->toArray()
        );
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('amount');
    }

    /** @test */
    public function request_should_fail_when_no_message_is_provided()
    {
        $response = $this->postJson(
            route('donations.store'),
            Donation::factory()->make(['message' => $this->faker->lexify(str_repeat('?', 201))])->toArray()
        );
        $response->assertStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('message');
    }

    /** @test */
    public function request_should_pass_when_data_is_provided()
    {
        $response = $this->postJson(route('donations.store'), Donation::factory()->make()->toArray());
        $response->assertStatus(HttpResponse::HTTP_CREATED);
        $response->assertJsonMissingValidationErrors(['name', 'email', 'amount', 'message']);
    }
}

<?php

namespace Database\Factories;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-20 days', '+20 days');
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'amount' => rand(0, 100),
            'message' => $this->faker->sentence(5),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}

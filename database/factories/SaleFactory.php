<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}

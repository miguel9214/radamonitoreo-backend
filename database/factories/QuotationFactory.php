<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quotation;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    protected $model = Quotation::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}

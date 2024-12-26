<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeastSelling;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeastSelling>
 */
class LeastSellingFactory extends Factory
{
    protected $model = LeastSelling::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'quantity_sold' => $this->faker->numberBetween(1, 100),
        ];
    }
}

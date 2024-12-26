<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BestSelling;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BestSelling>
 */
class BestSellingFactory extends Factory
{
    protected $model = BestSelling::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'quantity_sold' => $this->faker->numberBetween(1, 100),
        ];
    }
}

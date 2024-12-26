<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Purchase;
use App\Models\Supplier;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = Purchase::class;

    public function definition()
    {
        return [
            'supplier_id' => Supplier::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}  


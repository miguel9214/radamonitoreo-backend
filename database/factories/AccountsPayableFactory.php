<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccountsPayable;
use App\Models\Supplier;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountsPayable>
 */
class AccountsPayableFactory extends Factory
{
    protected $model = AccountsPayable::class;

    public function definition()
    {
        return [
            'supplier_id' => Supplier::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'paid']),
        ];
    }
}

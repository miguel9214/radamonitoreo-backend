<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AccountsReceivable;
use App\Models\Customer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountsReceivable>
 */
class AccountsReceivableFactory extends Factory
{
    protected $model = AccountsReceivable::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['pending', 'paid']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CashRegister;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashRegister>
 */
class CashRegisterFactory extends Factory
{
    protected $model = CashRegister::class;

    public function definition()
    {
        return [
            'initial_amount' => $this->faker->randomFloat(2, 100, 1000),
            'final_amount' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}

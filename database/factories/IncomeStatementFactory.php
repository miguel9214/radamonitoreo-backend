<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IncomeStatement;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeStatement>
 */
class IncomeStatementFactory extends Factory
{
    protected $model = IncomeStatement::class;

    public function definition()
    {
        return [
            'total_income' => $this->faker->randomFloat(2, 1000, 10000),
            'total_expense' => $this->faker->randomFloat(2, 500, 5000),
            'net_income' => $this->faker->randomFloat(2, 500, 5000),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IncomeQuery;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomeQuery>
 */
class IncomeQueryFactory extends Factory
{

    protected $model = IncomeQuery::class;

    public function definition()
    {
        return [
            'total_income' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}

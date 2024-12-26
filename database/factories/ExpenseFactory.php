<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expense;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */

 class ExpenseFactory extends Factory
 {
     protected $model = Expense::class;

     public function definition()
     {
         return [
             'description' => $this->faker->sentence,
             'amount' => $this->faker->randomFloat(2, 10, 1000),
         ];
     }
 }

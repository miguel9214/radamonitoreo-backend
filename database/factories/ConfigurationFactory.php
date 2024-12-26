<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Configuration;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuration>
 */
class ConfigurationFactory extends Factory
{
    protected $model = Configuration::class;

    public function definition()
    {
        return [
            'key' => $this->faker->word,
            'value' => $this->faker->word,
        ];
    }
}

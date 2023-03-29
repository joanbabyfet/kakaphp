<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class mod_configFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'          => 'string',
            'name'          => $this->faker->unique()->word,
            'value'         => $this->faker->word,
            'title'         => $this->faker->word,
            'group'         => 'config',
            'sort'          => 0,
            'create_time'   => $this->faker->unixTime('now'),
            'create_user'   => '1',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class mod_news_catFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //定义仅该文件能用最大内存，建议不要定义在php.ini会造成每个文件都能用到512M, /生成10万条数据需至少512M
        ini_set('memory_limit', '512M');

        return [
            'pid'           => 0,
            'name'          => $this->faker->unique()->word,
            'desc'          => $this->faker->word,
            'sort'          => 0,
            'status'        => 1,
            'create_time'   => $this->faker->unixTime('now'),
            'create_user'   => '1',
        ];
    }
}

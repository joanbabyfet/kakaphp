<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class mod_member_online_dataFactory extends Factory
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
            'agent_id'              => '9eff3e40b42fa665b18437d2e91a7b3c',
            'member_online_count'   => 0,
            'game1'                 => 0,
            'game2'                 => 0,
            'game3'                 => 0,
            'game4'                 => 0,
            'game5'                 => 0,
            'game6'                 => 0,
            'game7'                 => 0,
            'game8'                 => 0,
            'game9'                 => 0,
            'game10'                 => 0,
            'create_time'           => $this->faker->unixTime('now'),
        ];
    }
}

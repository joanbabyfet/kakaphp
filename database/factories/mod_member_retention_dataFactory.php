<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class mod_member_retention_dataFactory extends Factory
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
            'date'                  => $this->faker->date("Y/m/d", 'now'),
            'agent_id'              => '9eff3e40b42fa665b18437d2e91a7b3c',
            'timezone'              => get_admin_timezone(),
            'member_register_count' => 10,
            'd1'                    => 0,
            'd3'                    => 0,
            'd7'                    => 0,
            'd14'                   => 0,
            'd30'                   => 0,
            'create_time'           => $this->faker->unixTime('now'),
        ];
    }
}

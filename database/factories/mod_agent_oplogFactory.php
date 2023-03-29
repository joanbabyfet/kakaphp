<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Session;

class mod_agent_oplogFactory extends Factory
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
            'uid'           => '9eff3e40b42fa665b18437d2e91a7b3c',
            'username'      => 'agent1',
            'session_id'    => Session::getId(),
            'msg'           => $this->faker->word,
            'module_id'     => 0,
            'op_time'       => $this->faker->unixTime('now'),
            'op_ip'         => $this->faker->ipv4,
            'op_country'    => '-',
            'op_url'        => '',
        ];
    }
}

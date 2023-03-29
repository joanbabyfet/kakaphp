<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Session;

class mod_agentFactory extends Factory
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
            'id'                => random('web'),
            'pid'               => '9eff3e40b42fa665b18437d2e91a7b3c',
            'username'          => $this->faker->unique()->userName,
            'password'          => bcrypt('abc123#'),
            'avatar'            => '',
            'realname'          => $this->faker->name,
            'desc'              => '',
            'agent_balance'     => 0,
            'remain_balance'    => 0,
            'email'             => $this->faker->email,
            'phone_code'        => '',
            'phone'             => '',
            'status'            => 1,
            'safe_ips'          => '',
            'is_first_login'    => 1,
            'is_audit'          => 0,
            'session_expire'    => 1440,
            'session_id'        => Session::getId(),
            'reg_ip'            => $this->faker->ipv4,
            'login_time'        => $this->faker->unixTime('now'),
            'login_ip'          => $this->faker->ipv4,
            'login_country'     => '',
            'create_time'       => $this->faker->unixTime('now'),
            'create_user'       => '1',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Session;

class mod_user_login_logFactory extends Factory
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
            'uid'           => '09496c2d28f28ddabefb7ef2e278e95d',
            'username'      => 'agent1_chris',
            'status'        => 1,
            'session_id'    => Session::getId(),
            'agent'         => request()->userAgent(),
            'login_time'    => $this->faker->unixTime('now'),
            'login_ip'      => $this->faker->ipv4,
            'login_country' => '-',
            'cli_hash'      => '',
        ];
    }
}

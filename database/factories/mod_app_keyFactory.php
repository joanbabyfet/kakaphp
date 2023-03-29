<?php

namespace Database\Factories;

use App\repositories\repo_app_key;
use Illuminate\Database\Eloquent\Factories\Factory;

class mod_app_keyFactory extends Factory
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
        $key_data = app(repo_app_key::class)->create_app_key();
        $app_id = $key_data['app_id'];
        $app_key = $key_data['app_key'];

        return [
            'app_id'        => $app_id,
            'app_key'       => $app_key,
            'agent_id'      => random('web'),
            'desc'          => $this->faker->word,
            'create_time'   => $this->faker->unixTime('now'),
            'create_user'   => '1',
        ];
    }
}

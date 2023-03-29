<?php

namespace Tests\Unit\services;

use App\services\serv_user;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_userTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_user;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_user = app(serv_user::class);
    }

    /**
     * 测试检测该用户名是否已注册
     */
    public function test_is_registered()
    {
        $data = [
            'account' =>  'agent1_chris'
        ];

        $status = $this->serv_user->is_registered($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试检测该用户是否为新增用户
     */
    public function test_is_new_user()
    {
        $status = $this->serv_user->is_new_user('09496c2d28f28ddabefb7ef2e278e95d');
        $this->assertEquals(0, $status);
    }
}

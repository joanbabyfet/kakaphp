<?php

namespace Tests\Unit\services;

use App\services\serv_redis;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_redisTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_redis;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_redis = app(serv_redis::class);
    }

    /**
     * 测试清除运营后台菜单缓存
     */
    public function test_clear_admin_menu()
    {
        $status = $this->serv_redis->clear_admin_menu();
        $this->assertTrue($status);
    }

    /**
     * 测试清除代理后台菜单缓存
     */
    public function test_clear_agent_menu()
    {
        $status = $this->serv_redis->clear_agent_menu();
        $this->assertTrue($status);
    }

    /**
     * 测试清除角色和权限缓存
     */
    public function test_clear_permission()
    {
        $status = $this->serv_redis->clear_permission();
        $this->assertTrue($status);
    }

    /**
     * 测试清除系统配置缓存
     */
    public function test_clear_sys_db_config()
    {
        $status = $this->serv_redis->clear_sys_db_config();
        $this->assertTrue($status);
    }
}

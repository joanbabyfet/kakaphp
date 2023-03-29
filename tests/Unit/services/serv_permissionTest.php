<?php

namespace Tests\Unit\services;

use App\services\serv_permission;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_permissionTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_permission;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_permission = app(serv_permission::class);
    }

    /**
     * 测试获取权限树形
     */
    public function test_get_tree()
    {
        $data = [
            'guard'    => config('global.admin.guard'),
            'order_by' => ['created_at', 'asc'],
            'is_auth'  => 1,
        ];
        $rows = $this->serv_permission->get_tree($data);
        $this->assertNotEmpty($rows);
    }
}

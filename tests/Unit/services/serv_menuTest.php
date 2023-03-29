<?php

namespace Tests\Unit\services;

use App\services\serv_menu;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_menuTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_menu;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_menu = app(serv_menu::class);
    }

    /**
     * 测试获取菜单列表
     */
    public function test_get_menu_data()
    {
        $data = [
            'guard'         => config('global.admin.guard'),
            'purviews'      => ['*'],
            'is_permission' => 1,
            'order_by'      => ['sort', 'asc']
        ];
        $rows = $this->serv_menu->get_menu_data($data);
        $this->assertNotEmpty($rows);
    }
}

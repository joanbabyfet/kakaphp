<?php

namespace Tests\Unit\repositories;

use App\Models\mod_menu;
use App\repositories\repo_menu;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_menuTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_menu;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_menu = app(repo_menu::class);
    }

    /**
     * 测试添加
     */
    public function test_add()
    {
        $data = [
            'do'            => 'add',
            'parent_id'     => 0,
            'name'          => $this->faker->unique()->word,
            'type'          => 1,
            'guard_name'    => 'admin',
            'url'           => '/xxx',
            'sort'          => 0,
            'is_show'       => 1,
            'status'        => 1,
        ];
        $status = $this->repo_menu->save($data, $ret_data);
        $this->assertEquals(1, $status);
        $this->assertNotEmpty($ret_data['id']);
    }

    /**
     * 测试修改
     */
    public function test_edit()
    {
        $info = mod_menu::factory()->create(); //先生成1条数据

        $data = [
            'do'            => 'edit',
            'id'            => $info->id,
            'parent_id'     => 0,
            'name'          => $this->faker->unique()->word,
            'type'          => 1,
            'guard_name'    => 'admin',
            'url'           => '/xxx',
            'sort'          => 0,
            'is_show'       => 1,
            'status'        => 1,
        ];
        $status = $this->repo_menu->save($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        //$info = mod_menu::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_menu->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_menu::factory()->create(); //先生成1条数据

        $data = [
            'id'  => $info->id
        ];
        $status = $this->repo_menu->del($data);
        $this->assertEquals(1, $status);
    }
}

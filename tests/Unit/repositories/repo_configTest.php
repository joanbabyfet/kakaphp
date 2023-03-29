<?php

namespace Tests\Unit\repositories;

use App\Models\mod_config;
use App\repositories\repo_config;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_configTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_config;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_config = app(repo_config::class);
    }

    /**
     * 测试添加
     */
    public function test_add()
    {
        $data = [
            'do'    => 'add',
            'type'  => 'string',
            'name'  => $this->faker->word,
            'value' => $this->faker->word,
            'title' => $this->faker->word,
            'group' => 'config',
            'sort'  => 0,
        ];
        $status = $this->repo_config->save($data, $ret_data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试修改
     */
    public function test_edit()
    {
        $info = mod_config::factory()->create(); //先生成1条数据

        $data = [
            'do'    => 'edit',
            'type'  => 'string',
            'name'  => $info->name,
            'value' => $this->faker->word,
            'title' => $this->faker->word,
            'group' => 'config',
            'sort'  => 999,
        ];
        $status = $this->repo_config->save($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        //$info = mod_config::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_config->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_config::factory()->create(); //先生成1条数据

        $data = [
            'name'  => $info->name
        ];
        $status = $this->repo_config->del($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取变量值从库
     */
    public function test_get_value()
    {
        $info = mod_config::factory()->create(); //先生成1条数据

        $row = $this->repo_config->get_value($info->name);
        $this->assertNotEmpty($row);
    }
}

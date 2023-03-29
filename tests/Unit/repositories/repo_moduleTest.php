<?php

namespace Tests\Unit\repositories;

use App\Models\mod_module;
use App\repositories\repo_module;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_moduleTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_module;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_module = app(repo_module::class);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        //$info = mod_module::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_module->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }
}

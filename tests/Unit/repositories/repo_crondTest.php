<?php

namespace Tests\Unit\repositories;

use App\Models\mod_crond;
use App\repositories\repo_crond;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_crondTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_crond;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_crond = app(repo_crond::class);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_crond::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_crond->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }
}

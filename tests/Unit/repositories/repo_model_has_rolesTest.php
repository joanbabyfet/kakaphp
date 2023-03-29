<?php

namespace Tests\Unit\repositories;

use App\repositories\repo_model_has_roles;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_model_has_rolesTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_model_has_roles;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_model_has_roles = app(repo_model_has_roles::class);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_model_has_roles->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }
}

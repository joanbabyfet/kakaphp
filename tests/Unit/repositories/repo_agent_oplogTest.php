<?php

namespace Tests\Unit\repositories;

use App\Models\mod_agent_oplog;
use App\repositories\repo_agent_oplog;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_agent_oplogTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_agent_oplog;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_agent_oplog = app(repo_agent_oplog::class);
    }

    /**
     * 测试添加
     */
//    public function test_add_log()
//    {
//        $status = $this->repo_agent_oplog->add_log("测试", 999);
//        $this->assertEquals(1, $status);
//    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_agent_oplog::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_agent_oplog->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_agent_oplog::factory()->create(); //先生成1条数据

        $data = [
            'id'  => $info->_id
        ];
        $status = $this->repo_agent_oplog->del($data);
        $this->assertEquals(1, $status);
    }
}

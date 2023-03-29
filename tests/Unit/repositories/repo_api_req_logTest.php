<?php

namespace Tests\Unit\repositories;

use App\Models\mod_api_req_log;
use App\repositories\repo_api_req_log;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_api_req_logTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_api_req_log;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_api_req_log = app(repo_api_req_log::class);
    }

    /**
     * 测试添加
     */
    public function test_add_log()
    {
        $res_data = [
            'code'      => 0,
            'msg'       => 'success',
            'timestamp' => time(),
            'data'      => []
        ];

        $data = [
            'type'      => config('global.admin.guard'),
            'url'       => request()->path(),
            'method'    => request()->method(),
            'res_data'  => $res_data,
        ];
        $status = $this->repo_api_req_log->add_log($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_api_req_log::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_api_req_log->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_api_req_log::factory()->create(); //先生成1条数据

        $data = [
            'id'  => $info->id
        ];
        $status = $this->repo_api_req_log->del($data);
        $this->assertEquals(1, $status);
    }
}

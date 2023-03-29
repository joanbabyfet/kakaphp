<?php

namespace Tests\Unit\repositories;

use App\Models\mod_admin_user_login_log;
use App\repositories\repo_admin_user_login_log;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class repo_admin_user_login_logTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_admin_user_login_log;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_admin_user_login_log = app(repo_admin_user_login_log::class);
    }

    /**
     * 测试添加
     */
    public function test_save()
    {
        $data = [
            'uid'       => '1',
            'username'  => 'admin',
            'status'    => 1,
        ];
        $status = $this->repo_admin_user_login_log->save($data, $ret_data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_admin_user_login_log::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_admin_user_login_log->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_admin_user_login_log::factory()->create(); //先生成1条数据

        $data = [
            'id'  => $info->_id
        ];
        $status = $this->repo_admin_user_login_log->del($data);
        $this->assertEquals(1, $status);
    }
}

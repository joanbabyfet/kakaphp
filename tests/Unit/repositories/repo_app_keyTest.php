<?php

namespace Tests\Unit\repositories;

use App\Models\mod_app_key;
use App\repositories\repo_app_key;
use Illuminate\Foundation\Testing\WithFaker;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase; //调用仓库才不会报错

class repo_app_keyTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_app_key;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_app_key = app(repo_app_key::class);
    }

    /**
     * 测试添加
     */
    public function test_add()
    {
        $key_data = $this->repo_app_key->create_app_key();
        $app_id = $key_data['app_id'];
        $app_key = $key_data['app_key'];

        $data = [
            'do'        => 'add',
            'app_id'    => $app_id,
            'app_key'   => $app_key,
            'agent_id'  => random('web'),
            'desc'      => $this->faker->word,
        ];
        $status = $this->repo_app_key->save($data, $ret_data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试修改
     */
    public function test_edit()
    {
        $info = mod_app_key::factory()->create(); //先生成1条数据
        $key_data = $this->repo_app_key->create_app_key();
        $app_key = $key_data['app_key'];

        $data = [
            'do'        => 'edit',
            'app_id'    => $info->app_id,
            'app_key'   => $app_key,
            'agent_id'  => random('web'),
            'desc'      => $this->faker->word,
        ];
        $status = $this->repo_app_key->save($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_app_key::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_app_key->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试详情
     */
    public function test_detail()
    {
        $info = mod_app_key::factory()->create(); //先生成1条数据

        $row = $this->repo_app_key->find(['where' => [['app_id', '=', $info->app_id]]]);
        $row = empty($row) ? []:$row->toArray();
        $this->assertNotEmpty($row);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_app_key::factory()->create(); //先生成1条数据

        $data = [
            'app_id'  => $info->app_id
        ];
        $status = $this->repo_app_key->del($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试生成app_id和密匙
     */
    public function test_create_app_key()
    {
        $key_data = $this->repo_app_key->create_app_key();
        $app_id = $key_data['app_id'];
        $app_key = $key_data['app_key'];

        $this->assertNotEmpty($app_id);
        $this->assertNotEmpty($app_key);
    }
}

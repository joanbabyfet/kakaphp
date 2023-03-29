<?php

namespace Tests\Unit\repositories;

use App\Models\mod_news;
use App\repositories\repo_news;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; //调用仓库才不会报错
use  Illuminate\Foundation\Testing\WithFaker;

class repo_newsTest extends TestCase
{
    use WithFaker; //使用假数据

    private $repo_news;

    public function setUp(): void
    {
        parent::setUp();
        $this->repo_news = app(repo_news::class);
    }

    /**
     * 测试添加
     */
    public function test_add()
    {
        $data = [
            'do'        => 'add',
            'cat_id'    => 1,
            'title'     => $this->faker->words(3, true),
            'content'   => $this->faker->realText(200),
            'sort'      => 0,
            'status'    => 1,
        ];
        $status = $this->repo_news->save($data, $ret_data);
        $this->assertEquals(1, $status);
        $this->assertNotEmpty($ret_data['id']);
    }

    /**
     * 测试修改
     */
    public function test_edit()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $data = [
            'do'        => 'edit',
            'id'        => $info->id,
            'cat_id'    => 1,
            'title'     => $this->faker->words(3, true),
            'content'   => $this->faker->realText(200),
            'sort'      => 999,
            'status'    => 1,
        ];
        $status = $this->repo_news->save($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试啟用
     * @throws \Throwable
     */
    public function test_enable()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
            'status'    => 1
        ];
        $status = $this->repo_news->change_status($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试禁用
     * @throws \Throwable
     */
    public function test_disable()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
            'status'    => 0
        ];
        $status = $this->repo_news->change_status($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试获取列表
     */
    public function test_get_list()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $data = [
            'page_size' => 20, //每页几条
            'page'      => 1, //第几页
            'count'     => 1, //是否返回总条数
        ];
        $rows = $this->repo_news->get_list($data);
        $this->assertNotEmpty($rows['lists']);
    }

    /**
     * 测试详情
     */
    public function test_detail()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $row = $this->repo_news->find(['where' => [['id', '=', $info->id]]]);
        $row = empty($row) ? []:$row->toArray();
        $this->assertNotEmpty($row);
    }

    /**
     * 测试删除
     * @throws \Throwable
     */
    public function test_del()
    {
        $info = mod_news::factory()->create(); //先生成1条数据

        $data = [
            'id'  => $info->id
        ];
        $status = $this->repo_news->del($data);
        $this->assertEquals(1, $status);
    }
}

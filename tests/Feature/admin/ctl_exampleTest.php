<?php

namespace Tests\Feature\admin;

use App\Models\mod_example;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_exampleTest extends TestCase
{
    use WithFaker; //使用假数据

    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZG1pbmFwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTgyNTM1MSwiZXhwIjoxNjc5ODI4OTUxLCJuYmYiOjE2Nzk4MjUzNTEsImp0aSI6ImxvZmdvdTl2Z2RINDhQOWkiLCJzdWIiOiIxIiwicHJ2IjoiOWEwNWUxMjNiYTk0ZTZkMDhmMzZmNzUxYTQ3MjMyNDdkZmM2YjRiYyIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9._RMf-O73L-AopT0IKuOCbbmN4SUAaidmlqgWAyqj6Lo',
        ];
    }

    /**
     * 测试获取列表
     */
    public function test_index()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.example.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'total',
                'lists' => [
                    '*' => [
                        'id',
                        'cat_id',
                        'title',
                        'content',
                        'img',
                        'file',
                        'is_hot',
                        'sort',
                        'status',
                        'create_time',
                        'create_user',
                        'update_time',
                        'update_user',
                        'delete_time',
                        'delete_user',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试添加
     */
    public function test_add()
    {
        $data = [
            'do'        => 'add',
            'cat_id'    => 0,
            'title'     => $this->faker->word,
            'content'   => $this->faker->word,
            'img'       => '',
            'sort'      => 0,
            'status'    => 1,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.example.add'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试修改
     */
    public function test_edit()
    {
        $info = mod_example::factory()->create(); //先生成1条数据
        $data = [
            'do'        => 'edit',
            'id'        => $info->id,
            'cat_id'    => 0,
            'title'     => $this->faker->word,
            'content'   => $this->faker->word,
            'img'       => '',
            'sort'      => 0,
            'status'    => 1,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.example.edit'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试删除
     */
    public function test_delete()
    {
        $info = mod_example::factory()->create(); //先生成1条数据
        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.example.delete'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试开启
     */
    public function test_enable()
    {
        $info = mod_example::factory()->create(); //先生成1条数据
        $data = [
            'ids'        => [$info->id],
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.example.enable'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试禁用
     */
    public function test_disable()
    {
        $info = mod_example::factory()->create(); //先生成1条数据
        $data = [
            'ids'        => [$info->id],
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.example.disable'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试详情
     */
    public function test_detail()
    {
        $info = mod_example::factory()->create(); //先生成1条数据

        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.example.detail').'?id='.$info->id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'id',
                'cat_id',
                'title',
                'content',
                'img',
                'file',
                'is_hot',
                'sort',
                'status',
                'create_time',
                'create_user',
                'update_time',
                'update_user',
                'delete_time',
                'delete_user',
            ]
        ]);
    }

    /**
     * 测试导出
     */
    public function test_export()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.example.export').'?fields[]=title&fields[]=content');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'file',
                'excel_file',
                'total_page',
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }
}

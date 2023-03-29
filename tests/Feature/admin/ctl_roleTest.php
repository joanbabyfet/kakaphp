<?php

namespace Tests\Feature\admin;

use App\Models\mod_role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_roleTest extends TestCase
{
    use WithFaker; //使用假数据

    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZG1pbmFwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTcyMDQ1NiwiZXhwIjoxNjc5NzI0MDU2LCJuYmYiOjE2Nzk3MjA0NTYsImp0aSI6IjI2ZmM5NEh2VzM0SDVTWGYiLCJzdWIiOiIxIiwicHJ2IjoiOWEwNWUxMjNiYTk0ZTZkMDhmMzZmNzUxYTQ3MjMyNDdkZmM2YjRiYyIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.2upRWL0C0Oo5EFoHHCrSyr8Q3J7s7PQK67JgKgxC3Lw',
        ];
    }

    /**
     * 测试获取列表
     */
    public function test_index()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.role.index'));
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
                        'name',
                        'guard_name',
                        'desc',
                        'created_at',
                        'updated_at',
                        'users_count',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试详情
     */
    public function test_detail()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.role.detail').'?id=3');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'id',
                'name',
                'guard_name',
                'desc',
                'created_at',
                'updated_at',
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
            'name'      => $this->faker->word,
            'desc'      => $this->faker->word,
            'permissions' => [1, 2, 3, 4, 5],
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.role.add'), $data);
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
        $info = mod_role::factory()->create(); //先生成1条数据
        $data = [
            'do'        => 'add',
            'id'        => $info->id,
            'name'      => $this->faker->word,
            'desc'      => $this->faker->word,
            'permissions' => [1, 2, 3, 4, 5],
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.role.edit'), $data);
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
        $info = mod_role::factory()->create(); //先生成1条数据
        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.role.delete'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
        $this->assertTrue($response['code'] == 0);
    }
}

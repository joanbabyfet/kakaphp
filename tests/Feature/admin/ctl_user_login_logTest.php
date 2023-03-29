<?php

namespace Tests\Feature\admin;

use App\Models\mod_user_login_log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_user_login_logTest extends TestCase
{
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
            ->get(Route('admin.user_login_log.index'));
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
                        'uid',
                        'username',
                        'status',
                        'session_id',
                        'agent',
                        'login_time',
                        'login_ip',
                        'login_country',
                        'exit_time',
                        'extra_info',
                        'status',
                        'cli_hash',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试删除
     */
    public function test_delete()
    {
        $info = mod_user_login_log::factory()->create(); //先生成1条数据
        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.user_login_log.delete'), $data);
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

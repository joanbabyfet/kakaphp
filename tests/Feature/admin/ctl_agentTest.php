<?php

namespace Tests\Feature\admin;

use App\Models\mod_agent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_agentTest extends TestCase
{
    use WithFaker; //使用假数据

    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZG1pbmFwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY4MDA5MDI4NiwiZXhwIjoxNjgwMDkzODg2LCJuYmYiOjE2ODAwOTAyODYsImp0aSI6IklXekI3SUhhN0pMVVhEVDEiLCJzdWIiOiIxIiwicHJ2IjoiOWEwNWUxMjNiYTk0ZTZkMDhmMzZmNzUxYTQ3MjMyNDdkZmM2YjRiYyIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.tCBYpN-FQav6lRkeg4l5nBJ4GIwJGo2aXgqJ4vEjtMo',
        ];
    }

    /**
     * 测试获取列表
     */
    public function test_index()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.agent.index'));
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
                        'pid',
                        'username',
                        'avatar',
                        'realname',
                        'desc',
                        'agent_balance',
                        'remain_balance',
                        'email',
                        'phone_code',
                        'phone',
                        'status',
                        'safe_ips',
                        'is_first_login',
                        'is_audit',
                        'session_expire',
                        'session_id',
                        'reg_ip',
                        'login_time',
                        'login_ip',
                        'login_country',
                        'contact_person',
                        'domain',
                        'currency',
                        'wallet_type',
                        'create_time',
                        'create_user',
                        'update_time',
                        'update_user',
                        'delete_time',
                        'delete_user',
                        'create_time_text',
                        'create_user_maps',
                        'app_key_maps',
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
            ->get(Route('admin.agent.detail').'?id=9eff3e40b42fa665b18437d2e91a7b3c');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'id',
                'pid',
                'username',
                'avatar',
                'realname',
                'desc',
                'agent_balance',
                'remain_balance',
                'email',
                'phone_code',
                'phone',
                'status',
                'safe_ips',
                'is_first_login',
                'is_audit',
                'session_expire',
                'session_id',
                'reg_ip',
                'login_time',
                'login_ip',
                'login_country',
                'contact_person',
                'domain',
                'currency',
                'wallet_type',
                'create_time',
                'create_user',
                'update_time',
                'update_user',
                'delete_time',
                'delete_user',
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
            'do'            => 'add',
            'username'      => $this->faker->unique()->userName,
            'password'      => 'abc123#',
            'realname'      => $this->faker->name,
            'desc'          => $this->faker->word,
            'status'        => 1,
            'agent_balance' => 1000
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.agent.add'), $data);
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
//    public function test_edit()
//    {
//        $info = mod_agent::factory()->create(); //先生成1条数据
//
//        $data = [
//            'do'            => 'edit',
//            'id'            => $info->id,
//            'password'      => 'abc123#',
//            'realname'      => $this->faker->name,
//            'desc'          => $this->faker->word,
//            'status'        => 1,
//            'agent_balance' => 2000,
//        ];
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('admin.agent.edit'), $data);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => []
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }

    /**
     * 测试删除
     */
    public function test_delete()
    {
        $info = mod_agent::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.agent.delete'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
    }

    /**
     * 测试启用
     */
    public function test_enable()
    {
        $info = mod_agent::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.agent.enable'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => []
        ]);
    }

    /**
     * 测试禁用
     */
    public function test_disable()
    {
        $info = mod_agent::factory()->create(); //先生成1条数据

        $data = [
            'ids'        => [$info->id],
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.agent.disable'), $data);
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

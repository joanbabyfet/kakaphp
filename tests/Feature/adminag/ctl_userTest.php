<?php

namespace Tests\Feature\adminag;

use App\Models\mod_user;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_userTest extends TestCase
{
    use WithFaker; //使用假数据

    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZ2FwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTcyMTAzMywiZXhwIjoxNjc5NzI0NjMzLCJuYmYiOjE2Nzk3MjEwMzMsImp0aSI6IklRNndTTjlWTmVGN1hrbFciLCJzdWIiOiI5ZWZmM2U0MGI0MmZhNjY1YjE4NDM3ZDJlOTFhN2IzYyIsInBydiI6IjI2ZWVjM2EwZTVhNzFjMmI0YjBmZWQ4MWJmYmUxYTJlMjljNTQyMWUiLCJ1c2VybmFtZSI6ImFnZW50MSIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.Ndbc20CrFnkt9REDb5TiD7_YSthvICd0vyvar0a3Tx8',
        ];
    }

    /**
     * 测试获取用户列表
     */
    public function test_index()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.user.index'));
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
                        'agent_id',
                        'origin',
                        'username',
                        'avatar',
                        'realname',
                        'email',
                        'phone_code',
                        'phone',
                        'country_id',
                        'province_id',
                        'city_id',
                        'area_id',
                        'address',
                        'status',
                        'ban_desc',
                        'withdraw_limit',
                        'is_first_login',
                        'is_new_user',
                        'is_audit',
                        'session_expire',
                        'session_id',
                        'reg_ip',
                        'login_time',
                        'login_ip',
                        'login_country',
                        'language',
                        'currency',
                        'last_actived_time',
                        'online',
                        'client_id',
                        'conn_ip',
                        'conn_time',
                        'close_time',
                        'create_time',
                        'create_user',
                        'update_time',
                        'update_user',
                        'delete_time',
                        'delete_user',
                        'origin_text',
                        'is_new_user_text',
                        'status_text',
                        'create_time_text',
                        'login_time_text',
                        'agent_maps',
                        'wallet_maps',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取用户登录日志
     */
    public function test_login_log()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.user.login_log').'?uid=09496c2d28f28ddabefb7ef2e278e95d');
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
                        'session_id',
                        'agent',
                        'login_time',
                        'login_ip',
                        'login_country',
                        'exit_time',
                        'extra_info',
                        'status',
                        'cli_hash',
                        'status_text',
                        'login_time_text',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取黑名单列表
     */
    public function test_user_black_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.user.black_list'));
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
                        'agent_id',
                        'origin',
                        'username',
                        'avatar',
                        'realname',
                        'email',
                        'phone_code',
                        'phone',
                        'country_id',
                        'province_id',
                        'city_id',
                        'area_id',
                        'address',
                        'status',
                        'ban_desc',
                        'withdraw_limit',
                        'is_first_login',
                        'is_new_user',
                        'is_audit',
                        'session_expire',
                        'session_id',
                        'reg_ip',
                        'login_time',
                        'login_ip',
                        'login_country',
                        'language',
                        'currency',
                        'last_actived_time',
                        'online',
                        'client_id',
                        'conn_ip',
                        'conn_time',
                        'close_time',
                        'create_time',
                        'create_user',
                        'update_time',
                        'update_user',
                        'delete_time',
                        'delete_user',
                        'origin_text',
                        'is_new_user_text',
                        'status_text',
                        'create_time_text',
                        'login_time_text',
                        'agent_maps',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试解封用户
     */
    public function test_enable()
    {
        $info = mod_user::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('adminag.user.enable'), $data);
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
     * 测试封禁用户
     */
    public function test_disable()
    {
        $info = mod_user::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
            'ban_desc'  => $this->faker->words,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('adminag.user.disable'), $data);
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

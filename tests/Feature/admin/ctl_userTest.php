<?php

namespace Tests\Feature\admin;

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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZG1pbmFwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY4MDA4OTEzNCwiZXhwIjoxNjgwMDkyNzM0LCJuYmYiOjE2ODAwODkxMzQsImp0aSI6IlMyd0FlS3RrTE9ZTnN3T2siLCJzdWIiOiIxIiwicHJ2IjoiOWEwNWUxMjNiYTk0ZTZkMDhmMzZmNzUxYTQ3MjMyNDdkZmM2YjRiYyIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.mLj-5bLqCEnE1ObfXz2p1z-RlXxinVV2uicTx-9Eleg',
        ];
    }

    /**
     * 测试获取列表
     */
    public function test_index()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.user.index'));
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
     * 测试详情
     */
    public function test_detail()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.user.detail').'?id=09496c2d28f28ddabefb7ef2e278e95d');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
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
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取黑名单列表
     */
    public function test_black_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.user.black_list'));
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
     * 测试开启
     */
    public function test_enable()
    {
        $info = mod_user::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.user.enable'), $data);
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
        $info = mod_user::factory()->create(); //先生成1条数据

        $data = [
            'id'        => $info->id,
            'ban_desc'  => $this->faker->words,
        ];

        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.user.disable'), $data);
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
     * 测试获取登录日志
     */
    public function test_login_log()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.user.login_log').'?uid=09496c2d28f28ddabefb7ef2e278e95d');
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
}

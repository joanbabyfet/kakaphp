<?php

namespace Tests\Feature\adminag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_indexTest extends TestCase
{
    private $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZ2FwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTgyMzczNSwiZXhwIjoxNjc5ODI3MzM1LCJuYmYiOjE2Nzk4MjM3MzUsImp0aSI6InRNSGRVblNOdGxDMFBmNDQiLCJzdWIiOiI5ZWZmM2U0MGI0MmZhNjY1YjE4NDM3ZDJlOTFhN2IzYyIsInBydiI6IjI2ZWVjM2EwZTVhNzFjMmI0YjBmZWQ4MWJmYmUxYTJlMjljNTQyMWUiLCJ1c2VybmFtZSI6ImFnZW50MSIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.qqo9XQ0A3nmLmz7MfE5L6CUAF5l69zp_yfEUxiynXso',
        ];
    }

    /**
     * 测试ping
     */
    public function test_login()
    {
        $response = $this->withHeaders($this->headers)
            ->post(Route('adminag.index.login'), [
                'username' => 'agent1',
                'password' => 'abc123#',
                'captcha'  => '123123',
                'key'      => '',
            ]);
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
                'access_token',
                'token_type',
                'token_expire',
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取代理信息
     */
    public function test_userinfo()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.index.detail'));
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
                'role_maps',
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试修改用户自己密码
     */
    public function test_edit_pwd()
    {
        $response = $this->withHeaders($this->headers)
            ->post(Route('adminag.index.edit_pwd'), [
                'id'            => 'agent1',
                'old_password'  => 'abc123#',
                'password'      => 'abc123#',
            ]);
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
     * 测试获取后台菜单
     */
    public function test_get_menu()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.index.get_menu'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                '*' => [
                    'id',
                    'parent_id',
                    'name',
                    'url',
                    'icon',
                    'perms',
                    'is_show',
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试登出
     */
    public function test_logout()
    {
        $response = $this->withHeaders($this->headers)
            ->post(Route('adminag.index.logout'), []);
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

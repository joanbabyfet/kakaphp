<?php

namespace Tests\Feature\admin;

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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZG1pbmFwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTc1NzUwMSwiZXhwIjoxNjc5NzYxMTAxLCJuYmYiOjE2Nzk3NTc1MDEsImp0aSI6IlNDVFplOHFkcUJvNmVkR3kiLCJzdWIiOiIxIiwicHJ2IjoiOWEwNWUxMjNiYTk0ZTZkMDhmMzZmNzUxYTQ3MjMyNDdkZmM2YjRiYyIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.-mLp4DrEvjvilGQB8alHyH-SCgxh1fbGohDhPFObJhc',
        ];
    }

    /**
     * 测试ping
     */
    public function test_login()
    {
        $response = $this->withHeaders($this->headers)
            ->post(Route('admin.index.login'), [
                'username' => 'admin',
                'password' => 'Bb123456',
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
                'username',
                'avatar',
                'realname',
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
            ->get(Route('admin.index.detail'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'id',
                'username',
                'avatar',
                'realname',
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
            ->post(Route('admin.index.edit_pwd'), [
                'id'            => '1',
                'old_password'  => 'Bb123456',
                'password'      => 'Bb123456',
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
            ->get(Route('admin.index.get_menu'));
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
//    public function test_logout()
//    {
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('admin.index.logout'), []);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => []
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }
}

<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_commonTest extends TestCase
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
     * 测试ping
     */
    public function test_ping()
    {
        $response = $this->get(Route('admin.common.ping'));
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
     * 测试返回客戶端ip
     */
    public function test_ip()
    {
        $response = $this->get(Route('admin.common.ip'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'ip'
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取图片验证码
     */
    public function test_get_captcha()
    {
        $response = $this->get(Route('admin.common.get_captcha'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'captcha' => [
                    'sensitive',
                    'key',
                    'img',
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试重载图片验证码
     */
    public function test_reload_captcha()
    {
        $response = $this->get(Route('admin.common.reload_captcha'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'captcha' => [
                    'sensitive',
                    'key',
                    'img',
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取角色选项
     */
    public function test_get_role_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.common.get_role_options'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取渠道选项
     */
    public function test_get_agent_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.common.get_agent_options'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取模块选项
     */
    public function test_get_module_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.common.get_module_options'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取代理操作员选项
     */
    public function test_get_op_agent_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.common.get_op_agent_options'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取管理操作员选项
     */
    public function test_get_op_admin_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.common.get_op_admin_options'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }
}

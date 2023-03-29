<?php

namespace Tests\Feature\adminag;

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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZ2FwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY3OTcyMTAzMywiZXhwIjoxNjc5NzI0NjMzLCJuYmYiOjE2Nzk3MjEwMzMsImp0aSI6IklRNndTTjlWTmVGN1hrbFciLCJzdWIiOiI5ZWZmM2U0MGI0MmZhNjY1YjE4NDM3ZDJlOTFhN2IzYyIsInBydiI6IjI2ZWVjM2EwZTVhNzFjMmI0YjBmZWQ4MWJmYmUxYTJlMjljNTQyMWUiLCJ1c2VybmFtZSI6ImFnZW50MSIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.Ndbc20CrFnkt9REDb5TiD7_YSthvICd0vyvar0a3Tx8',
        ];
    }

    /**
     * 测试ping
     */
    public function test_ping()
    {
        $response = $this->get(Route('adminag.common.ping'));
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
        $response = $this->get(Route('adminag.common.ip'));
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
        $response = $this->get(Route('adminag.common.get_captcha'));
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
        $response = $this->get(Route('adminag.common.reload_captcha'));
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
            ->get(Route('adminag.common.get_role_options'));
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
     * 测试获取用户选项
     */
    public function test_get_user_options()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('adminag.common.get_user_options'));
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

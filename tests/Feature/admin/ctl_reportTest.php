<?php

namespace Tests\Feature\admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ctl_reportTest extends TestCase
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
     * 测试获取用户活跃数据列表
     */
    public function test_member_active_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.report.member_active_list').'?date_start=2008/11/26');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'total',
                'lists' => [
                    '*' => [
                        'date',
                        'agent_id',
                        'timezone',
                        'member_active_count',
                        'd1',
                        'd3',
                        'd7',
                        'd14',
                        'd30',
                        'create_time',
                        'realname',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取用户留存数据列表
     */
    public function test_member_retention_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.report.member_retention_list').'/?date_start=2008/11/26');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'total',
                'lists' => [
                    '*' => [
                        'date',
                        'agent_id',
                        'timezone',
                        'member_register_count',
                        'd1',
                        'd3',
                        'd7',
                        'd14',
                        'd30',
                        'create_time',
                        'agent_maps',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取用户增长数据列表
     */
    public function test_member_increase_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.report.member_increase_list').'/?date_start=2008/11/26');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'total',
                'lists' => [
                    '*' => [
                        'date',
                        'agent_id',
                        'member_count',
                        'member_increase_count',
                        'agent_maps',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }

    /**
     * 测试获取用户在线数据列表
     */
    public function test_member_online_list()
    {
        $response = $this->withHeaders($this->headers)
            ->get(Route('admin.report.member_online_list'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'code',
            'msg',
            'timestamp',
            'data' => [
                'total',
                'lists' => [
                    '*' => [
                        'date',
                        'agent_id',
                        'h0',
                        'h1',
                        'h2',
                        'h3',
                        'h4',
                        'h5',
                        'h6',
                        'h7',
                        'h8',
                        'h9',
                        'h10',
                        'h11',
                        'h12',
                        'h13',
                        'h14',
                        'h15',
                        'h16',
                        'h17',
                        'h18',
                        'h19',
                        'h20',
                        'h21',
                        'h22',
                        'h23',
                        'realname',
                    ]
                ]
            ]
        ]);
        $this->assertTrue($response['code'] == 0);
    }
}

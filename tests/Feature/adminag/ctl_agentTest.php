<?php

namespace Tests\Feature\adminag;

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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hZ2FwaS5rYWthcGhwLmxvY2FsXC9sb2dpbiIsImlhdCI6MTY4MDAwNzM0MSwiZXhwIjoxNjgwMDEwOTQxLCJuYmYiOjE2ODAwMDczNDEsImp0aSI6InF3eXZIUm9MbGdlVDB1ODkiLCJzdWIiOiI5ZWZmM2U0MGI0MmZhNjY1YjE4NDM3ZDJlOTFhN2IzYyIsInBydiI6IjI2ZWVjM2EwZTVhNzFjMmI0YjBmZWQ4MWJmYmUxYTJlMjljNTQyMWUiLCJ1c2VybmFtZSI6ImFnZW50MSIsImhzdCI6ImI4MWRiNDljMzAyZjhjNWZjYzEzMjgyMjY5YWU4MDM0IiwiaXBhIjoiZjUyODc2NGQ2MjRkYjEyOWIzMmMyMWZiY2EwY2I4ZDYiLCJ1cmEiOiJjM2ZjZDllNTJmZDc3NWM0M2M5NTUzYTk2MWJmYzUyYyJ9.E7LwBHNuPMo-j3zbKGv_oxMVlE1xUED0TOxklEiJreI',
        ];
    }

    /**
     * 测试获取子帐号列表
     */
//    public function test_index()
//    {
//        $response = $this->withHeaders($this->headers)
//            ->get(Route('adminag.agent.index').'/?keyword=');
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => [
//                'total',
//                'lists' => [
//                    '*' => [
//                        'id',
//                        'pid',
//                        'username',
//                        'avatar',
//                        'realname',
//                        'desc',
//                        'agent_balance',
//                        'remain_balance',
//                        'email',
//                        'phone_code',
//                        'phone',
//                        'status',
//                        'safe_ips',
//                        'is_first_login',
//                        'is_audit',
//                        'session_expire',
//                        'session_id',
//                        'reg_ip',
//                        'login_time',
//                        'login_ip',
//                        'login_country',
//                        'contact_person',
//                        'domain',
//                        'currency',
//                        'wallet_type',
//                        'create_time',
//                        'create_user',
//                        'update_time',
//                        'update_user',
//                        'delete_time',
//                        'delete_user',
//                        'role_maps',
//                    ]
//                ]
//            ]
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }
//
//    /**
//     * 测试获取子帐号详情
//     */
////    public function test_detail()
////    {
////        $response = $this->withHeaders($this->headers)
////            ->get(Route('adminag.agent.detail').'?id=62ad802d0cf27f09364adf3f2ead37c7');
////        $response->assertStatus(200);
////        $response->assertJsonStructure([
////            'code',
////            'msg',
////            'timestamp',
////            'data' => [
////                'id',
////                'pid',
////                'username',
////                'avatar',
////                'realname',
////                'desc',
////                'agent_balance',
////                'remain_balance',
////                'email',
////                'phone_code',
////                'phone',
////                'status',
////                'safe_ips',
////                'is_first_login',
////                'is_audit',
////                'session_expire',
////                'session_id',
////                'reg_ip',
////                'login_time',
////                'login_ip',
////                'login_country',
////                'contact_person',
////                'domain',
////                'currency',
////                'wallet_type',
////                'create_time',
////                'create_user',
////                'update_time',
////                'update_user',
////                'delete_time',
////                'delete_user',
////            ]
////        ]);
////        $this->assertTrue($response['code'] == 0);
////    }
//
//    /**
//     * 测试添加子帐号
//     */
////    public function test_add()
////    {
////        $data = [
////            'username'  => $this->faker->userName,
////            'password'  => 'abc123#',
////            'realname'  => $this->faker->name,
////            'status'    => 1,
////        ];
////
////        $response = $this->withHeaders($this->headers)
////            ->post(Route('adminag.agent.add'), $data);
////        $response->assertStatus(200);
////        $response->assertJsonStructure([
////            'code',
////            'msg',
////            'timestamp',
////            'data' => []
////        ]);
////        $this->assertTrue($response['code'] == 0);
////    }
//
//    /**
//     * 测试修改子帐号
//     */
//    public function test_edit()
//    {
//        $info = mod_agent::factory()->create(); //先生成1条数据
//
//        $data = [
//            'id'        => $info->id,
//            'username'  => $this->faker->userName,
//            'password'  => 'abc123#',
//            'realname'  => $this->faker->name,
//            'status'    => 1,
//        ];
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('adminag.agent.edit'), $data);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => []
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }
//
//    /**
//     * 测试删除子帐号
//     */
//    public function test_delete()
//    {
//        $info = mod_agent::factory()->create(); //先生成1条数据
//
//        $data = [
//            'ids'        => [$info->id],
//        ];
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('adminag.agent.delete'), $data);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => []
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }
//
//    /**
//     * 测试开启子帐号
//     */
//    public function test_enable()
//    {
//        $info = mod_agent::factory()->create(); //先生成1条数据
//
//        $data = [
//            'ids'        => [$info->id],
//        ];
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('adminag.agent.enable'), $data);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => []
//        ]);
//        $this->assertTrue($response['code'] == 0);
//    }
//
//    /**
//     * 测试禁用子帐号
//     */
//    public function test_disable()
//    {
//        $info = mod_agent::factory()->create(); //先生成1条数据
//
//        $data = [
//            'ids'        => [$info->id],
//        ];
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('adminag.agent.disable'), $data);
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

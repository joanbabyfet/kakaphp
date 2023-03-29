<?php

namespace Tests\Unit\services;

use App\services\serv_send_sms;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_send_smsTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_send_sms;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_send_sms = app(serv_send_sms::class);
    }

    /**
     * 测试发送短信/消息
     */
    public function test_send_msg()
    {
        $status = $this->serv_send_sms->send_msg('0912345678', '测试测试测试');
        $this->assertEquals(1, $status);
    }
}

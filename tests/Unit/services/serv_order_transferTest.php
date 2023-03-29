<?php

namespace Tests\Unit\services;

use App\Models\mod_order_transfer;
use App\services\serv_order_transfer;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_order_transferTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_order_transfer;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_order_transfer = app(serv_order_transfer::class);
    }

    /**
     * 测试创建订单流程
     */
    public function test_create()
    {
        $data = [
            'origin'            => mod_order_transfer::ORIGIN_ADMIN, //运营后台下单
            'uid'               => '09496c2d28f28ddabefb7ef2e278e95d',
            'agent_id'          => '9eff3e40b42fa665b18437d2e91a7b3c',
            'transaction_id'    => '', //后台充值, 渠道的订单id为空字符串
            'type'              => 1, //充值
            'amount'            => 100,
            'currency'          => 'HKD',
            'remark'            => 'xxx',
        ];
        $status = $this->serv_order_transfer->create($data);
        $this->assertEquals(1, $status);
    }
}

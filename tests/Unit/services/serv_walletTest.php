<?php

namespace Tests\Unit\services;

use App\services\serv_wallet;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_walletTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_wallet;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_wallet = app(serv_wallet::class);
    }

    /**
     * 测试值/上分 (暂不使用改由rpc写入)
     */
    public function test_deposit()
    {
        $data = [
            'uid'       =>  '09496c2d28f28ddabefb7ef2e278e95d',
            'amount'    =>  '10',
            'order_id'  =>  '',
            'currency'  =>  '',
        ];

        $status = $this->serv_wallet->deposit($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试提款/下分 (暂不使用改由rpc写入)
     */
    public function test_withdraw()
    {
        $data = [
            'uid'       =>  '09496c2d28f28ddabefb7ef2e278e95d',
            'amount'    =>  '10',
            'order_id'  =>  '',
            'currency'  =>  '',
        ];

        $status = $this->serv_wallet->withdraw($data);
        $this->assertEquals(1, $status);
    }

    /**
     * 测试根据用户id获取钱包馀额
     */
    public function test_get_balance()
    {
        $uid = '09496c2d28f28ddabefb7ef2e278e95d';
        $balance = $this->serv_wallet->get_balance($uid);
        $this->assertNotEmpty(1, $balance);
    }
}

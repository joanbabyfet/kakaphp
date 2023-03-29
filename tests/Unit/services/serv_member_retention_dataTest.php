<?php

namespace Tests\Unit\services;

use App\services\serv_member_retention_data;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; //调用仓库才不会报错

class serv_member_retention_dataTest extends TestCase
{
    use WithFaker; //使用假数据

    private $serv_member_retention_data;

    public function setUp(): void
    {
        parent::setUp();
        $this->serv_member_retention_data = app(serv_member_retention_data::class);
    }

    /**
     * 测试生成数据
     */
    public function test_generate_data()
    {
        $from_date = date('Y/m/d', strtotime('-1 day'));
        $status = $this->serv_member_retention_data->generate_data($from_date);
        $this->assertEquals(1, $status);
    }
}

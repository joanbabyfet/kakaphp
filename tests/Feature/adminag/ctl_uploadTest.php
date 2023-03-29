<?php

namespace Tests\Feature\adminag;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ctl_uploadTest extends TestCase
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
     * 测试普通上传
     */
//    public function test_upload()
//    {
//        //在该路径 storage/framework/testing/disks/xxx 创建目录
//        //Storage::fake('avatars');
//
//        $response = $this->withHeaders($this->headers)
//            ->post(Route('adminag.upload.upload'), [
//                'file' => UploadedFile::fake()->image('avatar.jpg')
//            ]);
//        $response->assertStatus(200);
//        $response->assertJsonStructure([
//            'code',
//            'msg',
//            'timestamp',
//            'data' => [
//                'realname',
//                'filename',
//                'filelink',
//            ]
//        ]);
//        $this->assertTrue($response['code'] == 0);
//        //断言文件是否存在
//        Storage::disk('public')->assertExists("image/{$response['data']['filename']}");
//    }
}

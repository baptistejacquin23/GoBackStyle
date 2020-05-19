<?php

namespace Tests\Feature;

use App\Code;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CodeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function setUp(): void{
        parent::setUp();

        putenv('DB_DEFAULT=sqlite_testing');

    }
    public function tearDown(): void{
        parent::tearDown();
    }

    public function testCodeList()
    {
        $response = $this->call('GET', 'code/list');
        $this->assertEquals(302, $response->status());

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('code/list');
        $this->assertEquals(200, $response->status());
    }

    public function testCodeCreate()
    {
        $user = factory(User::class)->make();

         $response = $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);
        $response->assertRedirect('/code/list');

        $code = Code::all()->first();

        $this->assertEquals("Code de test", $code->name);

    }

    public function testCodeModify()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);

        $response = $this->actingAs($user)->post('/code/update/1', [
            'name' => "Code de test après modification",
        ]);

        $response->assertRedirect('/code/list');

        $code = Code::all()->first();

        $this->assertEquals("Code de test après modification", $code->name);

    }

    public function testCodeDelete()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);

        $code_before_delete = Code::all()->count();
        $this->assertEquals(1, $code_before_delete);

        $this->actingAs($user)->post('/code/delete/1');

        $code_after_delete = Code::all()->count();
        $this->assertEquals(0, $code_after_delete);

    }
}

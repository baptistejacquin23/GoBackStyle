<?php

namespace Tests\Feature;

use App\Code;
use App\Promotion;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PromotionTest extends TestCase
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

    public function testPromotionList()
    {
        $response = $this->call('GET', 'promotion/list');
        $this->assertEquals(302, $response->status());

        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get('promotion/list');
        $this->assertEquals(200, $response->status());
    }

    public function testPromotionCreate()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);

        $this->assertEquals(1,Code::all()->count());


         $response = $this->actingAs($user)->post('/promotion/store', [
            'discount' => "Promotion de test",
             'description' =>"test",
             'link' =>'test',
             'imagePath' => UploadedFile::fake()->image('avatar.jpg'),
             'start_date' => Carbon::now(),
             'end_date' => Carbon::now(),
             'code' => 1
        ]);

        $response->assertRedirect('/promotion/list');

        Storage::disk('public')->assertExists('avatar.jpg');
        Storage::disk('public')->delete('avatar.jpg');

        $promotion = Promotion::all()->first();
        $this->assertEquals("Promotion de test", $promotion->discount);
    }

    public function testPromotionModify()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);

        $this->assertEquals(1,Code::all()->count());

        $response = $this->actingAs($user)->post('/promotion/store', [
            'discount' => "Promotion de test",
            'description' =>"test",
            'link' =>'test',
            'imagePath' => UploadedFile::fake()->image('avatar.jpg'),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'code' => 1
        ]);

        $response->assertRedirect('/promotion/list');
        Storage::disk('public')->assertExists('avatar.jpg');
        Storage::disk('public')->delete('avatar.jpg');

        $promotion_before_modify = Promotion::all()->first();
        $this->assertEquals("Promotion de test", $promotion_before_modify->discount);

        $response = $this->actingAs($user)->post('/promotion/update/1', [
            'discount' => "Promotion après la modification",
            'description' =>"test",
            'link' =>'test',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'code' => 1
        ]);

        $promotion_after_modify = Promotion::all()->first();

        $response->assertRedirect('/promotion/list');
        $this->assertEquals("Promotion après la modification", $promotion_after_modify->discount);

    }

    public function testCodeDelete()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)->post('/code/store', [
            'name' => "Code de test",
        ]);

        $this->assertEquals(1,Code::all()->count());

        $response = $this->actingAs($user)->post('/promotion/store', [
            'discount' => "Promotion de test",
            'description' =>"test",
            'link' =>'test',
            'imagePath' => UploadedFile::fake()->image('avatar.jpg'),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'code' => 1
        ]);

        $response->assertRedirect('/promotion/list');

        Storage::disk('public')->assertExists('avatar.jpg');
        Storage::disk('public')->delete('avatar.jpg');
        $promotion = Promotion::all()->first();

        $this->assertEquals("Promotion de test", $promotion->discount);

        $promotion_before_delete = Promotion::all()->count();
        $this->assertEquals(1, $promotion_before_delete);

        $this->actingAs($user)->post('/promotion/delete/1');
        $promotion_after_delete = Promotion::all()->count();
        $this->assertEquals(0, $promotion_after_delete);
    }
}

<?php

namespace Tests\Feature;

use App\Code;
use App\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiUnitTest extends TestCase
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

    public function testApiGetPromotions()
    {
        $code = new Code();
        $code->id = 1;
        $code->name = "test";
        $savedCode = $code->save();
        $this->assertTrue($savedCode);

        $promotion = new Promotion();
        $promotion->discount = "-20%";
        $promotion->description = "description";
        $promotion->link = "link";
        $promotion->image_path = "image_path";
        $promotion->validate_start_date = \date("Y-m-d");
        $promotion->validate_end_date = \date('Y-m-d', strtotime("+1 day"));
        $promotion->code_id = 1;
        $savedPromotion =  $promotion->save();
        $this->assertTrue($savedPromotion);

        $response = $this->json('GET', '/api/promotions/test');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "discount" => "-20%",
            "description" => "description",
            "image_path" => "image_path",
            "link" => "link",
            "validate_start_date" => \date("Y-m-d"),
            "validate_end_date" => \date('Y-m-d', strtotime("+1 day")),
        ]);
    }

    public function testApiCodeExistButNoPromotions()
    {
        $code = new Code();
        $code->name = "test";
        $savedCode = $code->save();
        $this->assertTrue($savedCode);

        $response = $this->json('GET', '/api/promotions/test');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "error" => "Aucune promotion pour ce code"
            ]);
    }

    public function testApiCodeDoesntExist()
    {

        $response = $this->json('GET', '/api/promotions/test');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "error" => "Code promo non connu"
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('discount');
            $table->string('description');
            $table->string('link');
            $table->string('image_path');
            $table->date('validate_start_date');
            $table->date('validate_end_date');
            $table->unsignedBigInteger('code_id')->index();
            $table->timestamps();
        });

        Schema::table('promotions', function($table) {
            $table->foreign('code_id')->references('id')->on('codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->dropForeign(['code_id']);
        });

        Schema::dropIfExists('promotions');
    }
}

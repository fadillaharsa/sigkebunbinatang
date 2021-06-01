<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('feeds', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('facility_id');
    $table->string('category');
    $table->integer('price');
    $table->text('description');
    $table->timestamps();
    $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}

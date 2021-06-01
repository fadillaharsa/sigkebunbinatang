<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
Schema::create('facilities', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('code')->unique();
    $table->text('photo');
    $table->text('description');
    $table->string('category');    
    $table->string('latitude');
    $table->string('longitude');
    $table->text('icon');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}

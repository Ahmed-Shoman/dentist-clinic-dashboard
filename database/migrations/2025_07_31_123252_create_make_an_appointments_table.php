<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('make_an_appointments', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('main_image')->nullable();
        $table->string('sub_image')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('make_an_appointments');
    }
};
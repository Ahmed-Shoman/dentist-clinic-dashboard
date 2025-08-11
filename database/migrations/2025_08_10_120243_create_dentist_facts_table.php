<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dentist_facts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('facts')->nullable();
            $table->string('time_table_title')->nullable();
            $table->text('time_table_description')->nullable();
            $table->json('schedule')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dentist_facts');
    }
};
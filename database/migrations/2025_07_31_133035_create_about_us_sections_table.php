<?php

// database/migrations/xxxx_xx_xx_create_about_us_sections_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_us_sections', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->json('cards')->nullable(); // JSON array of title, name, position
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us_sections');
    }
};
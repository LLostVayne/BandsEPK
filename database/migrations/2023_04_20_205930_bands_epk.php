<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("bands_epk",function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('description');
            $table->mediumText('biography');
            $table->string('youtube_link');
            $table->json('managed_by');
            $table->string('text_color',10)->nullable();
            $table->string('background_color',10)->nullable();
            $table->string('image',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("bands_epk");
    }
};

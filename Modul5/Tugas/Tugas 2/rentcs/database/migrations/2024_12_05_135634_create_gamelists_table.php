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
        Schema::create('gamelists', function (Blueprint $table) {
            $table->id();
            $table->string('gamename');
            $table->string('genre');
            $table->string('release');
            $table->text('description');
            $table->string('rating');
            $table->string('img_game');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamelists');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('game', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('id_creator');
            $table->integer('winner_one')->nullable();
            $table->integer('winner_tow')->nullable();
            $table->integer('winner_three')->nullable();
            $table->decimal('value_number', 10, 2);
            $table->integer('total_number');
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('table_game');
    }
};

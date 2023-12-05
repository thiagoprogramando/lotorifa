<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('game', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('id_creator');
            $table->foreign('id_creator')->references('id')->on('users')->onDelete('cascade');
            $table->integer('winner_one')->nullable();
            $table->integer('number_one')->nullable();
            $table->integer('winner_two')->nullable();
            $table->integer('number_two')->nullable();
            $table->integer('winner_three')->nullable();
            $table->integer('number_three')->nullable();
            $table->decimal('value_number', 10, 2);
            $table->integer('total_number');
            $table->integer('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('game');
    }
};

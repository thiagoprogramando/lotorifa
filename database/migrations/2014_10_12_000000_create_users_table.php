<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->integer('validation')->nullable();
            $table->integer('id_sponsor')->nullable();
            $table->string('coupon')->nullable();
            $table->string('token')->nullable();
            $table->integer('type');
            $table->integer('status')->nullable();
            $table->integer('points')->nullable();
            $table->decimal('wallet', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};

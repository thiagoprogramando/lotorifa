<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        
        Schema::create('bet', function (Blueprint $table) {
            $table->id();
            $table->integer('id_game');
            $table->integer('id_user')->nullable();
            $table->integer('number');
            $table->decimal('value', 10, 2);
            $table->decimal('netValue', 10, 2)->nullable();
            $table->string('token')->nullable();
            $table->date('dueDate')->nullable();
            $table->string('invoiceUrl')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bet');
    }
};

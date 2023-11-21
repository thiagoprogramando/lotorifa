<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('extract', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('type');
            $table->string('message');
            $table->decimal('value', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('extract');
    }
};

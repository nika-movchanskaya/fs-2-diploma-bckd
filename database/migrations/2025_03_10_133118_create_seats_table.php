<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained()->onDelete('cascade');
            $table->foreignId('film_session_id')->constrained('film_sessions')->onDelete('cascade');
            $table->integer('index_x');
            $table->integer('index_y');
            $table->boolean('is_vip')->default(false);
            $table->enum('status', ['disabled', 'purchased', 'available'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('x'); //number of seats per row
            $table->integer('y'); //number of rows
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('halls');
    }
};

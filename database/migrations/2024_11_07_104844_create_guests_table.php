<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name', 50)->comment('Имя гостя');
            $table->string('last_name', 50)->comment('Фамилия гостя');
            $table->string('email', 100)->unique()->comment('Уникальный email');
            $table->string('phone', 20)->unique()->comment('Уникальный телефон');
            $table->string('country', 50)->nullable()->index()->comment('Страна');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('guests');
    }
};

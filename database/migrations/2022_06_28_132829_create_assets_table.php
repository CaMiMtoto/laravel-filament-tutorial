<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('min_reservation')->nullable();
            $table->enum('min_reservation_unit', ['Hour', 'Day', 'Week', 'Month'])->default('Hour');
            $table->integer('max_reservation')->nullable();
            $table->enum('max_reservation_unit', ['Hour', 'Day', 'Week', 'Month'])->default('Hour');

            $table->integer('cancellation_time')->nullable();
            $table->enum('cancellation_time_unit', ['Hour', 'Day', 'Week', 'Month'])->default('Hour');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
};

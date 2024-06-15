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
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->id();
            $table->string('zip');
            $table->string('name');
            $table->string('type');
            $table->string('a0_name');
            $table->string('a1_name')->nullable();
            $table->string('a2_name')->nullable();
            $table->string('a3_name')->nullable();
            $table->string('a4_name')->nullable();
            $table->string('a5_name')->nullable();
            $table->string('a6_name')->nullable();
            $table->string('a7_name')->nullable();
            $table->string('a8_name')->nullable();
            $table->double('x_coordinate');
            $table->double('y_coordinate');
            $table->string('service_hours')->nullable();
            $table->string('temp_service_hours')->nullable();
            $table->string('temp_service_hours_until')->nullable();
            $table->string('temp_service_hours_2')->nullable();
            $table->string('temp_service_hours_2_until')->nullable();
            $table->string('comment_est')->nullable();
            $table->string('comment_eng')->nullable();
            $table->string('comment_rus')->nullable();
            $table->string('comment_lav')->nullable();
            $table->string('comment_lit')->nullable();
            $table->dateTime('modified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailboxes');
    }
};

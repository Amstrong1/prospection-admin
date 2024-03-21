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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('structure_id');
            $table->foreignId('user_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('company');
            $table->string('address');
            $table->string('tel');
            $table->string('email');
            $table->date('app_date');
            $table->time('app_time');
            $table->string('status');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};

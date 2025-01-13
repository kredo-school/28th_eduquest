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
        Schema::create('user_quest_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_quest_id');
            $table->unsignedBigInteger('status')
                    ->comment('0:watch later 1:in progress 2:completed');
            $table->dateTime('status_date');
            $table->timestamps();

            $table->foreign('user_quest_id')->references('id')->on('user_quest')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_quest_status');
    }
};

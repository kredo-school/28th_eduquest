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
        Schema::create('creators_qualifications', function (Blueprint $table) {
            $table->unsignedBigInteger('quest_creator_id');
            $table->unsignedBigInteger('quali_id');

            $table->foreign('quest_creator_id')->references('id')->on('quest_creators')->onDelete('cascade');
            $table->foreign('quali_id')->references('id')->on('qualifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creators_qualifications');
    }
};

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
        Schema::create('quests_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('quest_chapter_title');
            $table->text('description', 300);
            $table->text('video');
            $table->unsignedBigInteger('quest_id');
            $table->timestamps();

            $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests_chapters');
    }
};

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
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->string('quest_title');
            $table->text('description', 300);
            $table->longText('thumbnail');
            $table->float('total_hours', 3, 1);
            $table->unsignedBigInteger('quest_creator_id');
            $table->timestamps();

            $table->foreign('quest_creator_id')->references('id')->on('quest_creators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};

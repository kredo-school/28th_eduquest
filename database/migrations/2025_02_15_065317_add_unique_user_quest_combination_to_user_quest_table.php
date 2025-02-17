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
        Schema::table('user_quest', function (Blueprint $table) {
            
            $table->unique(['user_id', 'quest_id'], 'user_quest_user_id_quest_id_unique');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_quest', function (Blueprint $table) {    

            $table->dropUnique('user_quest_user_id_quest_id_unique');

        });
    }
};

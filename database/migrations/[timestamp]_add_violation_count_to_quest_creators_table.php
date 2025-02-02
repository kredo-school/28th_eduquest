<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('quest_creators', function (Blueprint $table) {
            $table->integer('violation_count')->default(0)->after('linkedin');
        });
    }

    public function down()
    {
        Schema::table('quest_creators', function (Blueprint $table) {
            $table->dropColumn('violation_count');
        });
    }
}; 
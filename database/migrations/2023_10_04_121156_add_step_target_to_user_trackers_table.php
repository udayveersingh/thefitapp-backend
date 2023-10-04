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
        Schema::table('user_trackers', function (Blueprint $table) {
            //
            $table->integer('step_target')->after('user_id')->default('5000');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_trackers', function (Blueprint $table) {
            //
            $table->dropColumn('step_target');
        });
    }
};

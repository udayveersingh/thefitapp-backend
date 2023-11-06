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
        Schema::table('user_income_summaries', function (Blueprint $table) {
            //
            $table->enum('refferal_payout',['0','1'])->default('0')->after('referred_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_income_summaries', function (Blueprint $table) {
            //
            $table->drop('refferal_payout');
        });
    }
};

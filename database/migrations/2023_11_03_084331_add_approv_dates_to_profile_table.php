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
        Schema::table('profiles', function (Blueprint $table) {
            //
            $table->dateTime('kyc_submit_date')->nullable()->after('kyc_status');
            $table->dateTime('kyc_approve_date')->nullable()->after('kyc_submit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            //
            $table->drop('kyc_submit_date');
            $table->drop('kyc_approve_date');
        });
    }
};

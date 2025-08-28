<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('coupons', function (Blueprint $table) {
        $table->unsignedBigInteger('event_id')->nullable()->after('coupon_code');
        $table->foreign('event_id')
              ->references('id')
              ->on('events')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('coupons', function (Blueprint $table) {
        $table->dropForeign(['event_id']);
        $table->dropColumn('event_id');
    });
}

};

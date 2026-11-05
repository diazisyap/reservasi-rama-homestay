<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('guest_name')->nullable()->after('user_id');
            $table->string('guest_email')->nullable()->after('guest_name');
            $table->string('guest_phone')->nullable()->after('guest_email');
            $table->string('payment_method')->nullable()->after('total_price');
            $table->decimal('tax_amount', 12, 2)->default(0)->after('payment_method');
            $table->decimal('service_amount', 12, 2)->default(0)->after('tax_amount');
            $table->decimal('base_price', 12, 2)->default(0)->after('service_amount');
            $table->integer('nights')->default(1)->after('base_price');
            $table->integer('guest_count')->default(1)->after('nights');
            $table->text('special_requests')->nullable()->after('guest_count');
            $table->string('booking_code')->unique()->nullable()->after('id');
            $table->timestamp('paid_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'guest_name', 'guest_email', 'guest_phone', 'payment_method',
                'tax_amount', 'service_amount', 'base_price', 'nights', 'guest_count',
                'special_requests', 'booking_code', 'paid_at'
            ]);
        });
    }
};

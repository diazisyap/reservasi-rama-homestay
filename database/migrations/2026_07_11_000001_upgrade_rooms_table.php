<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('type')->default('standard')->after('name'); // standard, deluxe, suite, villa
            $table->integer('capacity')->default(2)->after('total_rooms');
            $table->json('facilities')->nullable()->after('capacity'); // ["wifi","ac","pool","tv","kitchen"]
            $table->json('gallery')->nullable()->after('image'); // array of image paths
            $table->decimal('tax_rate', 5, 2)->default(10.00)->after('price'); // percentage
            $table->decimal('service_rate', 5, 2)->default(5.00)->after('tax_rate');
            $table->boolean('is_active')->default(true)->after('service_rate');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['type', 'capacity', 'facilities', 'gallery', 'tax_rate', 'service_rate', 'is_active']);
        });
    }
};

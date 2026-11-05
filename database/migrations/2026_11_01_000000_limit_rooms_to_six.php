<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Room;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove or deactivate any rooms beyond Kamar 6
        Room::whereIn('name', ['Kamar 7', 'Kamar 8', 'Kamar 9', 'Kamar 10'])
            ->orWhere(function ($q) {
                $q->where('name', 'like', 'Kamar %')
                  ->whereRaw("CAST(SUBSTRING(name, 7) AS UNSIGNED) > 6");
            })
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op
    }
};


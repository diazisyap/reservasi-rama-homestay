<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Room;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@ramahomestay.com'],
            [
                'name'     => 'Admin Rama',
                'phone'    => '081234567890',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Demo tamu
        $tamu = User::firstOrCreate(
            ['email' => 'tamu@demo.com'],
            [
                'name'     => 'Budi Santoso',
                'phone'    => '082198765432',
                'password' => Hash::make('password'),
                'role'     => 'tamu',
            ]
        );

        // Rooms (Kamar 1 - Kamar 6)
        $roomsData = [];
        for ($i = 1; $i <= 6; $i++) {
            $roomsData[] = [
                'name'         => "Kamar {$i}",
                'type'         => 'standard',
                'description'  => "Kamar {$i} nyaman dengan fasilitas Water Heater, WiFi, TV, dan kamar mandi dalam. Pilihan sempurna untuk menginap hemat dan nyaman.",
                'price'        => 300000,
                'tax_rate'     => 0,
                'service_rate' => 0,
                'total_rooms'  => 1,
                'capacity'     => 3,
                'facilities'   => ['wifi', 'water_heater', 'tv', 'parking'],
                'is_active'    => true,
            ];
        }

        foreach ($roomsData as $data) {
            Room::firstOrCreate(['name' => $data['name']], $data);
        }

        // Remove any room beyond Kamar 6
        Room::whereIn('name', ['Kamar 7', 'Kamar 8', 'Kamar 9', 'Kamar 10'])
            ->orWhere(function ($q) {
                $q->where('name', 'like', 'Kamar %')
                  ->whereRaw("CAST(SUBSTRING(name, 7) AS UNSIGNED) > 6");
            })
            ->delete();
    }
}

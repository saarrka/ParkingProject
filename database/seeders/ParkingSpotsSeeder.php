<?php

namespace Database\Seeders;

use App\Models\ParkingSpot;
use Illuminate\Database\Seeder;

class ParkingSpotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kreiraj 150 slobodnih parking mesta
        /*
        for ($i = 1; $i <= 150; $i++) {
            ParkingSpot::create([
                'spot_number' => $i,
                'is_occupied' => false, // Sva mesta su slobodna
                'user_id' => null, // Niko nije rezervisao
            ]);
        }
            */
    }
}

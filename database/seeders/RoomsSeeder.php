<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach(['North', 'East', 'South'] as $room) {
            Room::create([
                'title' => $room 
            ]);
        }
        
    }
}

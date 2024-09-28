<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer as Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $this->call(AbilitiesSeeder::class);
        $this->call(ParkingSpotsSeeder::class);

        
        // Popunjavamo podatke za admina
        $admin = User::create([
            'name' => 'Admin01',
            'email' => 'admin01@gmail.com',
            'password' => bcrypt('useradmin'),
            'mobile_number' => '1234567899',
            'user_name' => 'admin01'
        ]);

        // Dodeljujemo korisniku ulogu admina
        Bouncer::assign('admin')->to($admin);
        
        $manager = User::create([
            'name' => 'Manager01',
            'email' => 'manager01@gmail.com',
            'password' => bcrypt('manager0'),
            'mobile_number' => '0123456789',
            'user_name' => 'manager01'
        ]);

        Bouncer::assign('manager')->to($manager);
        
    }

}

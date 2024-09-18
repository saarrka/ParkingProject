<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Bouncer;

class AbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Abilities
        Bouncer::ability()->firstOrCreate([
            'name' => 'manage-users',
            'title' => 'Manage Users'
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'manage-categories',
            'title' => 'Manage Categories'
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'manage-vehicles',
            'title' => 'Manage Vehicles',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'generate-reports',
            'title' => 'Generate Reports',
        ]);

        // Manager abilities
        Bouncer::ability()->firstOrCreate([
            'name' => 'view-users',
            'title' => 'View Users',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'view-reports',
            'title' => 'View Reports',
        ]);

        // User abilities
        Bouncer::ability()->firstOrCreate([
            'name' => 'manage-own-vehicles',
            'title' => 'Manage Own Vehicles',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'view-categories',
            'title' => 'View Categories',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'contact-support',
            'title' => 'Contact Support',
        ]);
    }
}

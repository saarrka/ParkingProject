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

        Bouncer::allow('admin')->to(['manage-users', 'manage-categories', 'manage-vehicles', 'generate-reports', 'edit-profile']);

        // Manager abilities
        Bouncer::ability()->firstOrCreate([
            'name' => 'view-users',
            'title' => 'View Users',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'edit-profile',
            'title' => 'Edit profile',
        ]);

        Bouncer::ability()->firstOrCreate([
            'name' => 'view-reports',
            'title' => 'View Reports',
        ]);

        Bouncer::allow('manager')->to(['view-users', 'view-reports', 'edit-profile']);

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

        Bouncer::ability()->firstOrCreate([
            'name' => 'manage-own-reservations',
            'title' => 'Manage Own Reservations',
        ]);

        Bouncer::allow('user')->to(['manage-own-vehicles', 'view-categories', 'contact-support', 'manage-own-reservations', 'edit-profile']);
    }
}

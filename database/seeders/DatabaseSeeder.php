<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\LeadSource;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Test admin',
            'email'=> 'admin@admin.com'

        ]);

        Customer::factory()->count(20)->create();
     
        $leadSources = ['Website','Twitter','Phone'];

        foreach ($leadSources as $leadSource ) {
            LeadSource::create(['name' => $leadSource]);
        }

        $tags = ['Priority','VIP','Low'];

        foreach ($tags as $tag ) {
            Tag::create(['name' => $tag]);
        }
        

    }
}

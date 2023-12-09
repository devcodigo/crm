<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\LeadSource;
use App\Models\PipelineStage;
use App\Models\Role;
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

        $roles=["Admin","Employee"];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'Test admin',
            'email'=> 'admin@admin.com',
            'role_id' => Role::where('name','Admin')->first()?->id,

        ]);

        User::factory()->count(10)->create([
            'role_id' => Role::where('name','Employee')->first()?->id,  
        ]);
        

    
        $leadSources = ['Website','Twitter','Phone'];

        foreach ($leadSources as $leadSource ) {
            LeadSource::create(['name' => $leadSource]);
        }

        $tags = ['Priority','VIP','Low'];

        foreach ($tags as $tag ) {
            Tag::create(['name' => $tag]);
        }
        
        $pipelineStages = [
            [
                'name'=>'Lead',
                'position' => 1,
                'is_default'=> true,
            ],
            [
                'name'=>'Contact made',
                'position' => 2,
            ],
            [
                'name'=>'Proposal made',
                'position' => 3,
            ],
            [
                'name'=>'Proposal rejected',
                'position' => 4,
            ],
            [
                'name'=>'Customer',
                'position' => 5,
            ]
        ];

        foreach ($pipelineStages as $pipelineStage)
        {
            PipelineStage::create($pipelineStage);
        }

        $defaultPipelineStage = PipelineStage::where('is_default',true)->first()->id;

        Customer::factory()->count(10)->create([
               'pipeline_stage_id' => $defaultPipelineStage,
        ]);



    }
}

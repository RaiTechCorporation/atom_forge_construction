<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use App\Models\WebsiteContent;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberCount = 1;
        
        while ($name = WebsiteContent::where('key', "team_member_{$memberCount}_name")->first()) {
            $role = WebsiteContent::where('key', "team_member_{$memberCount}_role")->first();
            $bio = WebsiteContent::where('key', "team_member_{$memberCount}_bio")->first();
            $image = WebsiteContent::where('key', "team_member_{$memberCount}_image")->first();
            
            TeamMember::updateOrCreate(
                ['name' => $name->value],
                [
                    'role' => $role ? $role->value : '',
                    'bio' => $bio ? $bio->value : '',
                    'image_url' => $image ? $image->value : null,
                    'order' => $memberCount,
                    'is_active' => true,
                ]
            );
            
            // Delete the old keys
            WebsiteContent::where('key', "team_member_{$memberCount}_name")->delete();
            WebsiteContent::where('key', "team_member_{$memberCount}_role")->delete();
            WebsiteContent::where('key', "team_member_{$memberCount}_bio")->delete();
            WebsiteContent::where('key', "team_member_{$memberCount}_image")->delete();
            
            $memberCount++;
        }
    }
}

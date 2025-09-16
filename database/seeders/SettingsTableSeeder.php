<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            ['key' => 'organization_name', 'value' => 'Learnify Academy', 'group' => 'general'],
            ['key' => 'footer_text', 'value' => '© ' . date('Y') . ' Learnify. All rights reserved.', 'group' => 'branding'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'branding'],
            ['key' => 'email_signature', 'value' => "Thanks,\nTeam Learnify", 'group' => 'email'],
        ];
        foreach ($defaults as $row) {
            Setting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}

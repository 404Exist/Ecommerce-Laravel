<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'sitename' => ['en' => 'Website Name', 'ar' => 'اسم الموقع'],
        ]);
    }
}

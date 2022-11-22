<?php

namespace Database\Seeders;

use Core\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public function run()
    {
        Setting::query()->truncate();
        Setting::create([
            'key'=>'stimulsoft_custom_fonts',
            'value'=>'IRANSansWeb,IRANYekan'
        ]);
    }
}
